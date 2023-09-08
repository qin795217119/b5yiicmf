<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\traits;


use common\extend\exception\MyHttpException;
use common\extend\tools\PageUtils;
use common\extend\tools\QueryUtils;
use common\helpers\ExportHelper;
use common\helpers\Functions;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

trait CommonAction
{

    // public string $model
    // public bool $validate = false
    /**
     * 公共首页action
     * @return array|string
     */
    public function actionIndex()
    {
        if ($this->request->isPost) {
            $params = $this->request->post();
            /**
             * 自定义条件和参数
             * isTree 是否查询所有数据 真为所有，假为分页
             * pageSize和 pageNum  分别为每页条数和页码，当isTree为假时有效
             * isExport 是否导出excel  真为导出所有，假为不导出
             * orderBy 为排序数组 [$field=>asc/desc,..]
             * field 查询的字段，可以为字符串或数组  'field1,field2,..' 或 [field1,field2,..]
             * orderByColumn和 isAsc 是前端列表自带的排序参数
             * alias 表的简称，不为空时，会在条件和查询字段等 拼接该值，主要为了当你在indexQuery中需要join等联表查询时列名的冲突
            **/
            $params = $this->indexBefore($params);

            $extend = [];
            $isTree = $params['isTree'] ?? 0;//是否是树形tree，展示所有数据
            $isExport = $params['isExport'] ?? 0;//是否为导出excel，展示所有数据
            $debug = $params['debug'] ?? 0; // 是否输出sql语句
            $alias = $params['alias']??'';// 表名简称

            $query = $this->model::find(); //创建查询构建器
            if($alias) $query = $query->alias($alias);

            //处理表单查询条件
            try {
                $queryUtils = new QueryUtils($query,$params,$alias);
            }catch (MyHttpException $exception){
                return $this->error($exception->getMessage());
            }
            $query = $queryUtils->whereParse()->fieldParse()->orderParse()->getQuery();

            //操作查询对象，可以进行语句处理以及数据权限处理
            $queryResult = $this->indexQuery($query);
            if(is_array($queryResult)){
                $query = $queryResult['query'];
                $extend = $queryResult['extend']??[];
            }else{
                $query = $queryResult;
            }
            if ($debug) $extend['sql'] = $query->createCommand()->getRawSql();

            //是否分页
            if (!$isTree && !$isExport) {
                $count = (clone $query)->count();
                $pages = new PageUtils('pageNum','pageSize');
                $list = $this->indexAfter($query->offset($pages->getOffset())->limit($pages->getPageSize())->asArray()->all());
                return $this->success('',$list,['total' => (int)$count,'extend'=>(object)$extend]);
            }else{
                $list = $this->indexAfter($query->asArray()->all());
                //导出操作
                if ($isExport) {
                    if (method_exists($this,'exportCustom')){
                        return $this->exportCustom($list);
                    }
                    //结果查询后的处理
                    $export_data = $this->exportBefore($list);
                    try {
                        $excel_path = (new ExportHelper($export_data))->export();
                        return $this->success($excel_path);
                    }catch ( MyHttpException $exception){
                        return $this->error($exception->getMessage());
                    }
                } else {
                    return $this->success('', $list, ['total' => (int)count($list),'extend'=>(object)$extend]);
                }
            }
        } else {
            return $this->indexRender();
        }
    }

    /**
     * 公共新增action
     * @return array|string
     */
    public function actionAdd()
    {
        if ($this->request->isPost) {
            $data = $this->request->post();

            $model = new $this->model();
            if (!$model->load($data, '')) {
                return $this->error('无提交数据');
            }
            //验证
            if ($this->validate ?? false) {
                //验证前数据处理
                $validateBeforeRes = $this->validateBefore($model, 'add');
                if ($validateBeforeRes) {
                    return $this->error($validateBeforeRes);
                }

                if (!$model->validate()) {
                    return $this->error(Functions::getModelError($model));
                }
            }
            //数据处理
            $saveBeforeRes = $this->saveBefore($model, 'add');
            if ($saveBeforeRes) {
                return $this->error($saveBeforeRes);
            }
            $result = $model->save(false);
            if (!$result) {
                return $this->error(Functions::getModelError($model, '保存失败'));
            }
            $this->saveAfter($model, 'add');

            return $this->success('保存成功');
        } else {
            return $this->addRender();
        }
    }

    /**
     * 公共编辑action
     */
    public function actionEdit()
    {
        if ($this->request->isPost) {
            $data = $this->request->post();
            if(empty($data)) {
                return $this->error('无提交数据');
            }
            if(!isset($data['id']) || !$data['id']){
                return $this->error('缺少编辑主键条件');
            }
            $model = $this->model::findOne($data['id']);
            if(!$model){
                return $this->error('信息不存在');
            }
            if (!$model->load($data, '')) {
                return $this->error('加载数据失败');
            }
            if ($this->validate ?? false) {
                //验证前数据处理
                $validateBeforeRes = $this->validateBefore($model, 'edit');
                if ($validateBeforeRes) {
                    return $this->error($validateBeforeRes);
                }

                if (!$model->validate()) {
                    return $this->error(Functions::getModelError($model));
                }
            }
            //数据处理
            $saveBeforeRes = $this->saveBefore($model, 'edit');
            if ($saveBeforeRes) {
                return $this->error($saveBeforeRes);
            }
            $oldData = $model['oldAttributes'];
            $result = $model->save(false);
            if ($result === false) {
                return $this->error('保存失败');
            }
            if ($result) {
                $this->saveAfter($model, 'edit',$oldData);
            }
            return $this->success('保存成功');
        } else {
            $id = $this->request->get('id',0);
            if (!$id) {
                return $this->error('参数错误');
            }
            $info = $this->model::findOne($id);

            if (!$info) {
                return $this->error('信息不存在');
            }
            return $this->editRender($info);
        }
    }
    public function actionSetstatus()
    {
        if ($this->request->isPost) {
            $data = $this->request->post();
            $status = intval($data['status']) ? 1 : 0;
            $title = $data['name'] ?? '';
            $title = $title ?: ($status ? '启用' : '停用');
			$field = ($data['field']??'')?:'status';
            if(!isset($data['id']) || !$data['id']){
                return $this->error('缺少编辑主键条件');
            }
            $model = $this->model::findOne($data['id']);
            if(!$model){
                return $this->error('信息不存在');
            }
            if ($model[$field] == $status) {
                return $this->success($title . '成功');
            }

            $model[$field] = $status;
            $saveBeforeRes = $this->saveBefore($model,$field);
            if($saveBeforeRes){
                return $this->error($saveBeforeRes);
            }
            $oldData = $model['oldAttributes'];
            $result = $model->save(false);
            if ($result === false) {
                return $this->error($title.'失败');
            }
            if ($result) {
                $this->saveAfter($model, $field,$oldData);
            }
            return $this->success($title.'成功');

        }
        return $this->error('请求类型错误');
    }
    /**
     * 公共删除单条数据
     * @return array|string
     */
    public function actionDrop()
    {
        if ($this->request->isPost) {
            $id = $this->request->post('id', '');
            if (!$id) {
                return $this->error('参数缺失');
            }
            $info = $this->model::findOne($id);
            if (!$info) {
                return $this->error('信息不存在或数据已删除');
            }
            //删除前
            $res = $this->deleteBefore($info,'one');
            if ($res) {
                return $this->error($res);
            }

            $result = $info->delete();
            if ($result) {
                //删除后操作
                $this->deleteAfter($info,'one');
                return $this->success('删除成功');
            } else {
                return $this->error('删除失败');
            }
        }
        return $this->error('请求类型错误');
    }

    /**
     * 批量删除
     * @return array|string
     */
    public function actionDropall()
    {
        if ($this->request->isPost) {
            $ids = $this->request->post('ids', '');
            if (!$ids) {
                return $this->error('参数缺失');
            }
            $ids = explode(',', $ids);
            $number = 0;
            foreach ($ids as $id) {
                if (!$id) continue;
                $info = $this->model::findOne($id);
                if ($info) {
                    //删除前
                    $res = $this->deleteBefore($info,'batch');
                    if ($res) {
                        continue;
                    }
                    $result = $info->delete();
                    if ($result) {
                        $number++;
                        $this->deleteAfter($info,'batch');
                    }
                }
            }
            return $this->success('批量删除完成，共删除'.$number.'条数据');
        }
        return $this->error('请求类型错误');

    }

    /**
     * 首页渲染，方便重写
     * @return string
     */
    protected function indexRender(): string
    {
        return $this->render('', ['input' => $this->request->get()]);
    }

    /**
     * 添加渲染，方便重写
     * @return string
     */
    protected function addRender(): string
    {
        return $this->render('', ['input' => $this->request->get()]);
    }

    /**
     * 编辑渲染，方便重写
     * @param ActiveRecord $model
     * @return string
     */
    protected function editRender(ActiveRecord $model): string
    {
        return $this->render('', ['input' => $this->request->get(), 'info' => $model]);
    }

    /**
     * 首页查询前的params处理，方便添加额外的条件或排序等
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        return $params;
    }

    /**
     * 首页查询语句处理，可以用来自定义以及数据权限处理
     * @param $query
     * @return array|ActiveQuery 可以返回query对象，也可以一个数组['query'=>$query,'extend'=>[xxx]]  extend将会在ajax中返回
     */
    protected function indexQuery($query)
    {
        return $query;
    }

    /**
     * 首页列表查询完的操作，方便对列表进行处理
     * @param array $list
     * @return array
     */
    protected function indexAfter(array $list): array
    {
        return $list;
    }

    /**
     * 添加、编辑验证前的数据处理
     * @param ActiveRecord $model
     * @param string $type
     * @return string 正常返回空字符串，返回错误字符串则返回该错误
     */
    protected function validateBefore(ActiveRecord $model, string $type): string
    {
        return '';
    }

    /**
     * 添加、编辑、状态修改前的数据处理
     * @param ActiveRecord $model
     * @param string $type
     * @return string
     */
    protected function saveBefore(ActiveRecord $model, string $type): string
    {
        return '';
    }

    /**
     * 添加、编辑、状态修改后的操作
     * @param ActiveRecord $model
     * @param string $type
     * @param array $extend
     */
    protected function saveAfter(ActiveRecord $model, string $type,array $extend=[]): void
    {
    }

    /**
     * 删除后的操作
     * @param ActiveRecord $model
     * @param string $type
     */
    protected function deleteAfter(ActiveRecord $model,string $type): void
    {
    }

    /**
     * 删除前操作
     * @param ActiveRecord $model
     * @param string $type
     * @return string
     */
    protected function deleteBefore(ActiveRecord $model,string $type): string
    {
        return '';
    }

    /**
     * 导出配置，需配置导出字段 字段名=>标题
     * @param array $list
     * @return array[]
     */
    protected function exportBefore(array $list): array
    {
        return ['list' => $list, 'attributes' => []];
    }
}
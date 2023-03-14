<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\traits;


use common\helpers\ExportHelper;
use common\helpers\Functions;
use yii\db\Expression;
use yii\db\Query;

trait CommonAction
{
    /**
     * 公共首页action
     * @return array|string
     * @throws \yii\web\HttpException
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
            if (method_exists($this, 'indexBefore')) {
                $params = $this->indexBefore($params);
            }

            $extend = [];
            //是否是树形tree，展示所有数据
            $isTree = $params['isTree'] ?? 0;

            //是否为导出excel，展示所有数据
            $isExport = $params['isExport'] ?? 0;

//            $query = (new Query())->from($this->model::tableName());
            $query = $this->model::find();

            //是否需要拼接表名简称
            $alias = trim($params['alias']??'');
            if($alias){
                $query = $query->alias($alias);
            }
            $query = $this->indexWhere($query, $params, $alias);

            //操作查询对象，可以进行语句处理以及数据权限处理
            $queryResult = $this->indexQuery($query);
            if(is_array($queryResult)){
                $query = $queryResult['query'];
                $extend = $queryResult['extend']??[];
            }else{
                $query = $queryResult;
            }

            //是否分页
            if (!$isTree && !$isExport) {
                $pageSize = intval($params['pageSize'] ?? 10);
                $pageNum = intval($params['pageNum'] ?? 1);
                $pageNum = $pageNum < 1 ? 1 : $pageNum;
                $offset = ($pageNum - 1) * $pageSize;
                $count = (clone $query)->count();
                $query = $query->offset($offset)->limit($pageSize);
            }
//            $list = $query->all();
            $list = $query->asArray()->all();
            if ($isTree || $isExport) {
                $count = count($list);
            }
            //结果查询后的处理
            if (method_exists($this, 'indexAfter')) {
                $list = $this->indexAfter($list);
            }

            //导出操作
            if ($isExport) {
                //结果查询后的处理
                $export_data = $this->exportBefore($list);
                $excel_path = (new ExportHelper($export_data))->export();
                return $this->success($excel_path);
            } else {
                return $this->success('', $list, ['total' => (int)$count,'extend'=>(object)$extend]);
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
                if (true !== $validateBeforeRes) {
                    return $this->error($validateBeforeRes);
                }

                if (!$model->validate()) {
                    return $this->error(Functions::getModelError($model));
                }
            }
            //数据处理
            $saveBeforeRes = $this->saveBefore($model, 'add');
            if (true !== $saveBeforeRes) {
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
                if (true !== $validateBeforeRes) {
                    return $this->error($validateBeforeRes);
                }

                if (!$model->validate()) {
                    return $this->error(Functions::getModelError($model));
                }
            }
            //数据处理
            $saveBeforeRes = $this->saveBefore($model, 'edit');
            if (true !== $saveBeforeRes) {
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
            return $this->editRender($info->toArray());
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
            if ($model[$field] == $status) {
                return $this->success($title . '成功');
            }

            $model[$field] = $status;
            $saveBeforeRes = $this->saveBefore($model,$field);
            if(true !== $saveBeforeRes){
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
            $data = $info->toArray();
            //删除前
            $res = $this->deleteBefore($data,'one');
            if ($res !== true) {
                return $this->error($res);
            }

            $result = $info->delete();
            if ($result) {
                //删除后操作
                $this->deleteAfter($data,'one');
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
                    $data = $info->toArray();
                    //删除前
                    $res = $this->deleteBefore($data,'batch');
                    if ($res !== true) {
                        continue;
                    }
                    $result = $info->delete();
                    if ($result) {
                        $number++;
                        $this->deleteAfter($data,'batch');
                    }
                }
            }
            return $this->success('批量删除完成，共删除'.$number.'条数据');
        }
        return $this->error('请求类型错误');

    }

    /**
     * 将处理首页的过程 单独提取，便于自定义indexAction时使用
     * 可以根据自己的需求添加
     * @param $query
     * @param array $params
     * @param string $alias 拼接表面
     * @return mixed
     * @throws \Exception
     */
    protected function indexWhere($query, array $params = [],string $alias='')
    {
        $orderBy = $params['orderBy'] ?? [];//自定义的排序
        $orderByColumn = empty($params['orderByColumn']) ? '' : $params['orderByColumn'];
        $isAsc = empty($params['isAsc']) ? 'asc' : $params['isAsc'];
        $field = $params['field'] ?? '';
        //表单的条件 where 的条件
        if (isset($params['where']) && is_array($params['where'])) {
            foreach ($params['where'] as $key => $value) {
                if ($key && ($value || $value=='0')) {
                    $query = $query->andWhere([$this->joinAlias($key,$alias) => $value]);
                }
            }
        }

        //常用比较符
        $compareTag = ['eq'=>'=','neq'=>'<>','gt'=>'>','lt'=>'<','egt'=>'>=','elt'=>'<='];
        foreach ($compareTag as $tag=>$operate){
            if (isset($params[$tag]) && is_array($params[$tag])) {
                foreach ($params[$tag] as $key => $value) {
                    if ($key && ($value || $value=='0')) {
                        $query = $query->andWhere([$operate,$this->joinAlias($key,$alias), $value]);
                    }
                }
            }
        }

        //表单的条件 in 的条件
        if (isset($params['in']) && is_array($params['in'])) {
            foreach ($params['in'] as $key => $value) {
                if ($key && $value) {
                    $query = $query->andWhere([$this->joinAlias($key,$alias) => $value]);
                }
            }
        }

        //表单的条件 like 的条件
        if (isset($params['like']) && is_array($params['like'])) {
            foreach ($params['like'] as $key => $value) {
                if ($key && $value) {
                    $query = $query->andWhere(['like', $this->joinAlias($key,$alias), $value]);
                }
            }
        }

        //表单的条件 time 时间戳
        if(isset($params['time']) && is_array($params['time'])){
            foreach ($params['time'] as $key => $value) {
                if ($key && is_array($value) && count($value) > 1) {
                    $start = $value['start'] ?? '';
                    $end = $value['end'] ?? '';
                    if ($end) {
                        $end = strtotime($end);
                        if($end) $query->andWhere(['<=',$this->joinAlias($key,$alias),$end]);
                    }
                    if ($start) {
                        $start = strtotime($start);
                        if($start) $query->andWhere(['>=',$this->joinAlias($key,$alias),$start]);
                    }
                }
            }
        }


        //表单的条件 between 的条件 日期格式
        if (isset($params['between']) && is_array($params['between'])) {
            foreach ($params['between'] as $key => $value) {
                if ($key && is_array($value) && count($value) > 1) {
                    $start = $value['start'] ?? '';
                    $end = $value['end'] ?? '';
                    if ($end) {
                        $end = (new \DateTime($end))->modify('+1 day')->modify('-1 second')->format('Y-m-d H:i:s');
                    }
                    if ($start) {
                        $start = (new \DateTime($start))->format('Y-m-d H:i:s');
                    }
                    if ($start || $end) {
                        if ($start && $end) {
                            $query = $query->andWhere(['between', $this->joinAlias($key,$alias), $start, $end]);
                        } elseif ($start) {
                            $sqlStart = new Expression('UNIX_TIMESTAMP("' . $start . '")');
                            $query = $query->andWhere(['>=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key,$alias) . ')', $sqlStart]);
                        } elseif ($end) {
                            $sqlEnd = new Expression('UNIX_TIMESTAMP("' . $end . '")');
                            $query = $query->andWhere(['<=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key,$alias) . ')', $sqlEnd]);
                        }
                    }
                }
            }
        }

        //表单的条件 findinset 的条件
        if (isset($params['findinset']) && is_array($params['findinset'])) {
            foreach ($params['findinset'] as $key => $value) {
                if($key && $value){
                    $query = $query->andWhere(new Expression('FIND_IN_SET("' . $value . '", ' . $this->joinAlias($key,$alias) . ')'));
                }
            }
        }

        //处理字段
        if ($field) {
            if($alias){
                if(is_string($field)){
                    $field = explode(",",$field);
                }
                if(is_array($field)){
                    foreach ($field as $key=>$value){
                        $field[$key] = $this->joinAlias($value,$alias);
                    }
                }
            }
            $query = $query->select($field);
        }

        //处理排序
        $orderList= [];
        if ($orderByColumn) $orderList[$this->joinAlias($orderByColumn,$alias)] = strtolower($isAsc)=='asc'?SORT_ASC:SORT_DESC;
        // 指定排序
        foreach ($orderBy as $key => $val) {
            $key = $this->joinAlias($key,$alias);
            if(!array_key_exists($key,$orderList)){
                $orderList[$key] = strtolower($val)=='asc'?SORT_ASC:SORT_DESC;
            }
        }
        //默认最后加一个id asc
        if(!isset($orderList[$this->joinAlias('id',$alias)])) $orderList[$this->joinAlias('id',$alias)] = SORT_ASC;

        $query = $query->orderBy($orderList);

        return $query;
    }

    /**
     * 给字段拼接表名简称
     * @param $field
     * @param $alias
     * @return string
     */
    private function joinAlias($field,$alias){
        if(strpos($field,'.')){
            return $field;
        }
        if($alias) return $alias.'.'.$field;
        return $field;
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
     * @param array $info
     * @return string
     */
    protected function editRender(array $info): string
    {
        return $this->render('', ['input' => $this->request->get(), 'info' => $info]);
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
     * @return mixed 可以返回query对象，也可以一个数组['query'=>$query,'extend'=>[xxx]]  extend将会在ajax中返回
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
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @return bool|string 正常返回true，返回错误字符串则返回该错误
     */
    protected function validateBefore(\yii\db\ActiveRecord $model, string $type)
    {
        return true;
    }

    /**
     * 添加、编辑、状态修改前的数据处理
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @return bool|string
     */
    protected function saveBefore(\yii\db\ActiveRecord $model, string $type)
    {
        return true;
    }

    /**
     * 添加、编辑、状态修改后的操作
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @param array $extend
     */
    protected function saveAfter(\yii\db\ActiveRecord $model, string $type,array $extend=[]): void
    {
    }

    /**
     * 删除后的操作
     * @param array $data
     * @param string $type
     */
    protected function deleteAfter(array $data,string $type): void
    {
    }

    /**
     * 删除前操作
     * @param array $data
     * @param string $type
     * @return bool|string
     */
    protected function deleteBefore(array $data,string $type)
    {
        return true;
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
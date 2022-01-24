<?php


namespace backend\helpers;


use common\helpers\AdminExportApi;
use common\helpers\commonApi;
use yii\db\Expression;
use Yii;

trait commonAction
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            // 获取参数
            $argList = func_get_args();
            $pageList = $argList[0]??true;
            $extMap = $argList[1]??[];
            $extSort = $argList[2]??[];

            $map = [];
            $order_column = 'id';
            $order_sort = 'asc';
            $pageNum = 1;
            $pageSize = defined('PAGE_LIMIT') ? PAGE_LIMIT : 10;
            $total = 0;

            $param = Yii::$app->request->post();
            if ($param) {
                //表单的条件 where 的条件
                if (!empty($param['where']) && is_array($param['where'])) {
                    foreach ($param['where'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = [$paramField => $paramValue];
                        }
                    }
                }
                //表单的条件 like 的条件
                if (!empty($param['like']) && is_array($param['like'])) {
                    foreach ($param['like'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = ['like', $paramField, $paramValue];
                        }
                    }
                }
                //表单的条件 between 的条件
                if (!empty($param['between']) && is_array($param['between'])) {
                    foreach ($param['between'] as $paramField => $paramValue) {
                        if (is_array($paramValue) && count($paramValue) > 1) {
                            $start = $paramValue['start'];
                            $end = $paramValue['end'];
                            if ($start || $end) {
                                if ($start && $end) {
                                    $map[] = ['between', $paramField, $start, $end];
                                } elseif ($start) {
                                    $map[] = ['>', $paramField, $start];
                                } elseif ($end) {
                                    $map[] = ['<', $paramField, $end];
                                }
                            }
                        }
                    }
                }
                //表单的条件 findinset 的条件
                if (!empty($param['findinset']) && is_array($param['findinset'])) {
                    foreach ($param['findinset'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = [$paramField ,'findinset', $paramValue];
                        }
                    }
                }
                //排序条件
                if (!empty($param['orderByColumn'])) {
                    $order_column = trim($param['orderByColumn']);
                }
                if (!empty($param['isAsc'])) {
                    $order_sort = trim($param['isAsc']);
                }
                // 分页条件
                if (!empty($param['pageNum'])) $pageNum = intval($param['pageNum']);
                if (!empty($param['pageSize'])) $pageSize = intval($param['pageSize']);
            }

            if ($extMap) { // 查询条件合并
                $map = array_merge($map, $extMap);
            }

            $extSort = $extSort ?: [[$order_column, $order_sort]];// 指定排序

            $offset = ($pageNum - 1) * $pageSize; //分页开始

            //拼接sql
            $query = $this->model::find()->where('1');
            if (!empty($map)) {
                $query = $this->bWhereFilter($query, $map);
            }
            //若开启了分页获取总数
            if ($pageList) {
                $total = $query->count();
            }
            if (!empty($select)) { //指定查询字段
                $query = $query->select($select);
            }
            if ($pageList) { //指定分页
                $query = $query->offset($offset)->limit($pageSize);
            }
            if (!empty($extSort)) { // 指定排序
                $orderBy = [];
                foreach ($extSort as $key => $val) {
                    if (is_array($val)) {
                        $orderBy[] = $val[0] . ' ' . $val[1];
                    } else {
                        $orderBy[] = $key . ' ' . $val;
                    }
                }
                $orderBy = implode(',', $orderBy);
                $query = $query->orderBy($orderBy);
            }


            //导出判断
            $export = $param['isExport']??'0';
            if($export){
                $list = $query->all();
                $exportData = $this->handelExport($list);
                return AdminExportApi::run(new $this->model(),$exportData);
            }else{
                $list = $query->asArray()->all();
            }

            if (!$pageList) {
                $total = count($list);
            }
            return commonApi::message('操作成功', true, $list, 0, '', ['total' => (int)$total]);
        } else {
            $data = Yii::$app->request->get();
            return $this->render('', ['input' => $data]);
        }
    }
    protected function handelExport($list,array $columns=[],array  $headers=[]):array{
        return ['list'=>$list,'columns'=>$columns,'headers'=>$headers];
    }
    /**
     * 公共添加页
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $argList = func_get_args();
            $data = $argList[0] ?? [];
            if (!$data) {
                $data = Yii::$app->request->post();
            }
            if ($data) {
                $model = new $this->model();
                if (!$model->load($data, '')) {
                    return commonApi::message('无提交数据', false);
                }
                if (!$model->validate()) {
                    return commonApi::message(commonApi::getModelError($model), false);
                }
                $result = $model->save(false);
                if ($result) {
                    return commonApi::message('添加成功', true);
                } else {
                    return commonApi::message( '添加失败', false);
                }
            }
            return commonApi::message('无提交数据', false);
        } else {
            $data = Yii::$app->request->get();
            return $this->render('', ['input' => $data]);
        }
    }
    /**
     * 公共编辑页
     */
    public function actionEdit()
    {
        if (Yii::$app->request->isPost) {
            $argList = func_get_args();
            $data = $argList[0] ?? [];
            if (!$data) {
                $data = Yii::$app->request->post();
            }
            if ($data) {
                if (!isset($data['id']) || !$data['id']) {
                    return commonApi::message('缺少主键参数', false);
                }
                $model = $this->model::findOne($data['id']);
                if (!$model) {
                    return commonApi::message('信息不存在', false);
                }
                if (!$model->load($data, '')) {
                    return commonApi::message('无提交数据', false);
                }
                if (!$model->validate()) {
                    return commonApi::message(commonApi::getModelError($model), false);
                }
                $result = $model->save(false);
                if ($result !== false) {
                    return commonApi::message('保存成功', true);
                } else {
                    return commonApi::message('保存失败', false);
                }
            }
            return commonApi::message('无提交数据', false);
        }
        $info = [];
        $data = Yii::$app->request->get();
        if (isset($data['id']) && $data['id']) {
            $info = $this->model::findOne($data['id']);
        }
        if (empty($info)) {
            return $this->tError('参数或信息错误');
        }
        return $this->render('', ['info' => $info, 'input' => $data]);
    }
    /**
     * 公共删除
     */
    public function actionDrop()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        $field = $argList[1] ?? '';
        $url = $argList[2]??'';
        if (empty($data)) {
            $data = Yii::$app->request->post();
        }
        $field = $field?: 'id';
        $id = intval($data[$field]??0);
        if($id<1){
            return commonApi::message('参数错误', false);
        }
        $info = $this->model::findOne([$field=>$id]);
        if(!$info){
            return commonApi::message('信息不存在或已删除', false);
        }
        if(method_exists($this,'beforeDrop')){
            $before_result = $this->beforeDrop($info);
            if($before_result !== true){
                return $before_result;
            }
        }
        $result = $info->delete();
        if ($result) {
            return commonApi::message('删除成功', true, [], null, $url);
        }
        return commonApi::message('删除失败', false);
    }

    /**
     * 批量删除
     * @return array
     */
    public function actionDropall()
    {
        $argList = func_get_args();

        $data = $argList[0] ?? [];
        $field = $argList[1] ?? '';
        $url = $argList[2]??'';
        if (empty($data)) {
            $data = Yii::$app->request->post();
        }

        $field = $field?: 'id';
        $idArr=[];
        if($data && isset($data['ids'])){
            $ids = $data['ids'];
            if (!is_array($ids)) {
                $ids = trim($ids, ',');
                $ids = explode(',', $ids);
            }
            foreach ($ids as $id){
                if($id && !in_array($id,$idArr)){
                    $idArr[]=$id;
                }
            }
        }
        if (empty($idArr)) {
            return commonApi::message('未选择数据', false);
        }
        if (count($idArr) ==1) {
            $idArr = $idArr[0];
        }
        $result = $this->model::deleteAll([$field => $idArr]);
        if ($result) {
            return commonApi::message('删除成功', true, [], null, $url);
        }
        return commonApi::message('删除失败', false);
    }
    /**
     * 设置记录状态
     * @return mixed
     */
    public function actionSetstatus()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = Yii::$app->request->post();
        }
        if (!$data) return commonApi::message('参数错误', false);
        if (empty($data['id'])) {
            return commonApi::message('未选择数据', false);
        }
        if (!isset($data['status'])) {
            return commonApi::message('状态参数错误', false);
        }

        $info = $this->model::findOne($data['id']);
        if(!$info){
            return commonApi::message('信息不存在', false);
        }
        $info->status = $data['status'];
        $result = $info->save(false);
        $title = $data['status'] ? '启用' : '停用';
        if ($result) {
            return commonApi::message($title.'成功', true);
        }
        return commonApi::message($title . '失败', false);
    }
    /**
     * 处理自定义数组where条件
     * @param $query
     * @param $map
     * @return mixed
     */
    public function bWhereFilter($query, $map)
    {
        if (empty($map)) return $query;
        if (is_array($map)) {
            foreach ($map as $key => $val) {
                if (is_array($val)) {
                    if (count($val) == 3) {
                        if ($val[1] === 'findinset') {
                            $val = new Expression('FIND_IN_SET("' . $val[2] . '", ' . $val[0] . ')');
                        } elseif ($val[1] === 'in') {
                            $val = [$val[0] => $val[2]];
                        } elseif ($val[1] === '=') {
                            $val = [$val[0] => $val[2]];
                        }
                    }
                    $query = $query->andWhere($val);
                } else {
                    $query = $query->andWhere([$key => $val]);
                }

            }
        } else {
            $query = $query->andWhere($map);
        }
        return $query;
    }
}
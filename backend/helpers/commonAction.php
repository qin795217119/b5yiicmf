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
            $select = $argList[3]??[];
            return $this->listProcess($this->model,$pageList,$extMap,$extSort,$select);
        } else {
            $data = Yii::$app->request->get();
            return $this->render('', ['input' => $data]);
        }
    }
    public function listProcess($model,$pageList = true,$extMap = [],$extSort = [],$select=[]){
        $map = [];
        $order_column = 'id';
        $order_sort = 'asc';
        $pageNum = 1;
        $pageSize = defined('PAGE_LIMIT') ? PAGE_LIMIT : 10;
        $total = 0;

        $param = Yii::$app->request->post();
        $export = intval($param['isExport']??'0');

        $this->listWhere($param,$map,$order_column,$order_sort,$pageNum,$pageSize);


        if ($extMap) { // 查询条件合并
            $map = array_merge($map, $extMap);
        }

		//排序合并 post参数优先级最高，若不存在id并在最后拼接 id的增序
		if($extSort){
            foreach ($extSort as $key=>$value){
                if($value[0] == $order_column){
                    unset($extSort[$key]);
                }
            }
        }
        array_unshift($extSort,[$order_column, $order_sort]);
        $sortId = false;
        foreach ($extSort as $sortArr){
            if($sortArr[0] == 'id'){
                $sortId = true;
                break;
            }
        }
        if(!$sortId){
            $extSort[]=['id','asc'];
        }

        $offset = ($pageNum - 1) * $pageSize; //分页开始

        //拼接sql
        $query = $model::find()->where('1');
        if (!empty($map)) {
            $query = $this->bWhereFilter($query, $map);
        }
        //若开启了分页获取总数
        if ($pageList && !$export) {
            $total = $query->count();
        }
        if (!empty($select)) { //指定查询字段
            $query = $query->select($select);
        }
        if ($pageList && !$export) { //指定分页
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
        if($export){
            $list = $query->all();
            $exportData = $this->handelExport($list);
            return AdminExportApi::run($this->model,$exportData);
        }else{
            $list = $query->asArray()->all();
        }

        if (!$pageList) {
            $total = count($list);
        }
        return commonApi::message('操作成功', true, $list, 0, '', ['total' => (int)$total]);
    }
    //处理列表中的条件
    public function listWhere($param,&$map,&$order_column,&$order_sort,&$pageNum,&$pageSize){
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
                        if($end){
                            $end = (new \DateTime($end))->modify('+1 day')->modify('-1 second')->format('Y-m-d H:i:s');
                        }
                        if($start){
                            $start = (new \DateTime($start))->format('Y-m-d H:i:s');
                        }
                        if ($start || $end) {
                            if ($start && $end) {
                                $map[] = ['between', $paramField, $start, $end];
                            } elseif ($start) {
                                $sqlStart = new Expression('UNIX_TIMESTAMP("' . $start . '")');
                                $map[] = ['>=', 'UNIX_TIMESTAMP('.$paramField.')', $sqlStart];
                            } elseif ($end) {
                                $sqlEnd = new Expression('UNIX_TIMESTAMP("' . $end . '")');
                                $map[] = ['<=','UNIX_TIMESTAMP('.$paramField.')', $sqlEnd];
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
    }

    protected function handelExport($list):array{
        $columns=[];
        $headers=[];
        if(method_exists($this,'exportFilter')){
            //注意根据 ACTION_NAME 判断不同的导出
            return $this->exportFilter($list);
        }
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
                    if(method_exists($this,'afterSave')){
                        $this->afterSave($model->id,'add');
                    }
                    return commonApi::message('添加成功', true,['id'=>$model->id]);
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
                    if(method_exists($this,'afterSave')){
                        $this->afterSave($model->id,'edit');
                    }
                    return commonApi::message('保存成功', true,['id'=>$model->id]);
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

//    public function afterSave($id,$type){
//
//    }
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
            if(method_exists($this,'afterSave')){
                $this->afterSave($id,'delete');
            }
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
        foreach ($idArr as $id){
            $info = $this->model::findOne($id);
            if($info){
                $result = $info->delete();
                if ($result) {
                    if (method_exists($this, 'afterSave')) {
                        $this->afterSave($id, 'delete');
                    }
                }
            }
        }
        return commonApi::message('删除成功', true, [], null, $url);
//        $result = $this->model::deleteAll([$field => $idArr]);
//        if ($result) {
//            return commonApi::message('删除成功', true, [], null, $url);
//        }
//        return commonApi::message('删除失败', false);
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
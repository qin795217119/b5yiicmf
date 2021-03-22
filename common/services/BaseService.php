<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use Yii;
use common\helpers\commonApi;

/**
 * 服务类-基类
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    // 模型
    public $model;
    // 验证类
    public $validate = false;

    /**
     * 获取数据列表
     * @param bool $all
     * @return array
     */
    public function getList($all = false)
    {
        $map = [];
        $sort = [];
        $order_column = 'id';
        $order_sort = 'asc';
        $page = 1;
        $limit = PAGE_LIMIT;

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
                                $map[] = [$paramField, 'between', $start, $end];
                            } elseif ($start) {
                                $map[] = ['>', $paramField, $start];
                            } elseif ($end) {
                                $map[] = ['<', $paramField, $end];
                            }
                        }

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
            if (!empty($param['pageNum'])) $page = intval($param['pageNum']);
            if (!empty($param['pageSize'])) $limit = intval($param['pageSize']);
        }
        // 获取参数
        $argList = func_get_args();
        if (!empty($argList)) {
            // 查询条件合并
            $map_arg = (!empty($argList[1])) ? $argList[1] : [];
            if ($map_arg) {
                $map = array_merge($map, $map_arg);
            }
            // 排序
            $sort = (!empty($argList[2])) ? $argList[2] : [];
        }
        $sort || $sort = [[$order_column, $order_sort]];


        if ($all) {
            $list = $this->getAll($map, [], [], '', $sort);
            $count = count($list);
        } else {
            //只获取主键的列表
            $offset = ($page - 1) * $limit;
            $list = $this->getAll($map, [], [$offset, $limit], '', $sort);
            $count = $this->model->getCount($map);
        }
        $list = $this->after_getList($list,$param);

        return commonApi::message('操作成功', true, $list, 0, '', ['total' => $count]);
    }

    /**
     * 获取列表后对结果进行处理
     * @param $list
     * @param $param
     * @return mixed
     */
    public function after_getList($list,$param)
    {
        return $list;
    }

    /**
     * 获取数据列表
     * @param array $map
     * @param array $select
     * @param array $pageData
     * @param string $listKey
     * @param array $sort
     * @param bool $debug
     * @return array
     */
    public function getAll(array $map = [], array $select = [], array $pageData = [], string $listKey = '', array $sort = [['id', 'asc']],$debug=false)
    {
        $list = $this->model->getList($map, $select, $pageData, $listKey, $sort,$debug);
        return $list ?: [];
    }
    /**
     * 获取单条信息
     * @param $id
     * @param bool $isArray
     * @return mixed
     */
    public function info($id, $isArray = true)
    {
        $info = $this->model->info($id);
        if ($info && $isArray) {
            $info = $info->toArray();
        }
        return $info;
    }

    /**
     * 添加
     * @return array
     */
    public function add()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = Yii::$app->request->post();
        }
        if ($data) {
            $bres=$this->before_op($data,'edit');
            if(!$bres['success']){
                return $bres;
            }
            $data=$bres['data'];
            if(!$this->model->load($data, '')){
                return commonApi::message('无提交数据',false);
            }
            if ($this->validate && !$this->model->validate()) {
                return commonApi::message(commonApi::getModelError($this->model),false);
            }
            //演示限制
            if (commonApi::system_isDemo() && get_class($this) != 'common\services\LoginlogService') {
                return $this->demo_system();
            }
            $result = $this->model->save(false);
            $title=$argList[2] ?? '保存';
            if ($result) {
                $this->after_add($this->model->toArray());
                $url = $argList[1] ?? '';
                if (!$url) {
                    return commonApi::message($title.'成功', true);
                } else {
                    return commonApi::message($title.'成功', true, [], null, $url);
                }
            }else{
                return commonApi::message($title.'失败', true);
            }
        }
        return commonApi::message('操作失败', false);
    }

    /**
     * 批量插入
     * @param $field
     * @param $data
     * @return mixed
     */
    public function insertAll($field,$data){
        //演示限制
        if (commonApi::system_isDemo()) {
            return $this->demo_system();
        }
        return $this->model->insertAll($field,$data);
    }
    /**
     * 添加成功后的操作
     * @param $data
     * @return bool
     */
    protected function after_add($data)
    {
        return true;
    }
    public function before_op($data,$type=''){
        return commonApi::message('',true,$data);
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = Yii::$app->request->post();
        }
        if ($data) {
            $bres=$this->before_op($data,'edit');
            if(!$bres['success']){
                return $bres;
            }
            $data=$bres['data'];
            if($this->model->primaryKey){
                if(!isset($data[$this->model->primaryKey])){
                    return commonApi::message('缺少主键参数',false);
                }
                $model=$this->model->info($data[$this->model->primaryKey]);
                if(!$model){
                    return commonApi::message('信息不存在',false);
                }
            }else{
                $model=$this->model;
            }
            if(!$model->load($data, '')){
                return commonApi::message('无提交数据',false);
            }
            if ($this->validate && !$model->validate()) {
                return commonApi::message(commonApi::getModelError($model),false);
            }
            //演示限制
            if (commonApi::system_isDemo()) {
                return $this->demo_system();
            }
            $result = $model->save(false);
            $title=$argList[2] ?? '保存';
            if ($result !== false) {
                $this->after_edit($data);
                $url = $argList[1] ?? '';
                if (!$url) {
                    return commonApi::message($title.'成功', true);
                } else {
                    return commonApi::message($title.'成功', true, [], null, $url);
                }
            }else{
                return commonApi::message($title.'失败', true);
            }
        }
        return commonApi::message('操作失败', false);
    }

    public function demo_system()
    {
        return commonApi::message('演示环境无法此操作', false);
    }

    /**
     * 编辑成功后
     * @param $data
     * @return bool
     */
    protected function after_edit($data)
    {
        return true;
    }

    /**
     * 删除
     * @return array
     */
    public function drop()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (empty($data)) {
            $data = Yii::$app->request->post();
        }
        if (empty($data)) return commonApi::message('未获取到数据', false);
        $bres=$this->before_op($data,'drop');
        if(!$bres['success']){
            return $bres;
        }
        $data=$bres['data'];
        if (empty($data['ids'])) {
            return commonApi::message('未选择数据', false);
        }
        $field = $argList[1] ?? '';

        //演示限制
        if (commonApi::system_isDemo()) {
            return $this->demo_system();
        }

        $result = $this->model->drop($data['ids'], $field);
        if ($result) {
            $this->after_drop($data,$field);
            $url = $argList[2] ?? '';
            if (!$url) {
                return commonApi::message('删除成功', true);
            } else {
                return commonApi::message('删除成功', true, [], null, $url);
            }
        }
        return commonApi::message('删除失败', false);
    }

    /**
     * 删除成功后
     * @param $data
     * @return bool
     */
    protected function after_drop($data,$field)
    {
        return true;
    }

    /**
     * 设置记录状态
     * @return mixed
     */
    public function setStatus()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = Yii::$app->request->post();
        }
        if (!$data) return commonApi::message('为获取到数据', false);
        if (empty($data['id'])) {
            return commonApi::message('未选择数据', false);
        }
        if (!isset($data['status'])) {
            return commonApi::message('状态参数错误', false);
        }

        //演示限制
        if (commonApi::system_isDemo()) {
            return $this->demo_system();
        }

        $update = [$this->model->primaryKey => $data['id'], 'status' => $data['status']];
        $result = $this->model->edit($update);
        $title = $data['status'] ? '启用' : '停用';
        if ($result) {

            return commonApi::message('', true);
        }
        return commonApi::message($title . '失败', false);
    }
}

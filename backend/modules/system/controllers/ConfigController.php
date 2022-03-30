<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\modules\system\controllers;


use backend\extend\BaseController;
use common\services\system\ConfigService;
use backend\extend\traits\CommonAction;
use common\cache\ConfigCache;
use common\models\system\Config;

class ConfigController extends BaseController
{
    use CommonAction;
    protected $model = Config::class;
    protected $validate = true;


    /**
     * 网站设置
     * @return array|string
     */
    public function actionSite(){
        if($this->request->isPost){
            $params = $this->request->post();
            if(!$params) return $this->error('无更新数据');

            foreach ($params as $id => $value) {
                if($id){
                    Config::updateAll(['value'=>$value],['id'=>$id]);
                }
            }
            ConfigCache::clear();
            return $this->success('保存成功');
        }
        $lists=(new ConfigService())->getListByGroup();
        return $this->render('',['lists'=>$lists]);
    }

    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');
        return $this->render('', ['groupList' => $groupList,'styleList'=>$styleList]);
    }

    /**
     * 首页列表处理
     * @param $list
     * @return array
     */
    protected function indexAfter($list): array
    {
        if ($list) {
            $service = new ConfigService();
            $styleList = $service->styleList();
            $groupList = $service->getConfig('sys_config_group');
            foreach ($list as $key => $value) {
                $value['style_name'] = $styleList[$value['style']] ?? $value['style'];
                $value['group_name'] = $groupList[$value['groups']] ?? $value['groups'];
                $list[$key] = $value;
            }
        }
        return $list;
    }

    /**
     * 添加渲染
     * @return string
     */
    protected function addRender():string
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');

        return $this->render('', ['groupList' => $groupList, 'styleList' => $styleList]);
    }

    /**
     * 编辑渲染
     * @param $info
     * @return string
     */
    protected function editRender($info):string
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');
        return $this->render('', ['info' => $info, 'groupList' => $groupList, 'styleList' => $styleList]);
    }


    /**
     * 添加、修改后的操作
     */
    protected function saveAfter():void
    {
        ConfigCache::clear();
    }

    /**
     * 删除前操作
     * @param array $data
     * @return bool|string
     */
    protected function deleteBefore(array $data)
    {
        if($data['is_sys'] == 1){
            return '系统配置，无法删除';
        }
        return true;
    }

    /**
     * 删除后的操作
     */
    protected function deleteAfter():void
    {
        ConfigCache::clear();
    }


    /**
     * 导出excel处理数据及字段
     * @param $list
     * @return array
     */
    protected function exportBefore($list):array{
        //对list数据进行处理

        //返回导出的字段及字段名
        $attributes = [
            'title'=>'配置标题',
            'type'=>'配置标识',
            'style_name'=>'配置类型',
            'value'=>'配置值',
            'extra'=>'配置项',
            'update_time'=>'更新时间',
        ];
        return ['list'=>$list,'attributes'=>$attributes];
    }

}

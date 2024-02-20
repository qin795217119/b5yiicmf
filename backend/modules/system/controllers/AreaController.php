<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;

use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\models\system\Area;
use common\services\system\AreaService;


class AreaController extends BaseController
{
    use CommonAction;

    protected string $model = Area::class;

    protected function indexBefore(array $params): array
    {
        $p_code = trim($this->request->post('p_code', ''));
        $code = trim($this->request->post('code', ''));
        $name = trim($this->request->post('name', ''));
        if ($code) {
            $params['where']['code'] = $code;
        }
        if ($name) {
            $params['like']['name'] = $name;
        }
        if (!$code && !$name) {
            $params['where']['p_code'] = $p_code ?: 0;
        }

        $params['orderBy']['list_sort'] = 'asc';
        $params['orderBy']['code'] = 'asc';
        $params['isTree'] = 1;
        return $params;
    }

    protected function addRender(): string
    {
        $provinceList = AreaService::getListByPCode('0');
        return $this->render('', ['provinceList' => $provinceList]);
    }

    protected function editRender(Area $model): string
    {
        $pName = '--';
        if ($model->p_code) {
            $parent = AreaService::getAreaInfo($model->p_code);
            $pName = $parent ? $parent['name'] : '未知';
        }
        $provinceList = AreaService::getListByPCode('0');
        return $this->render('', ['info' => $model, 'provinceList' => $provinceList, 'p_name' => $pName]);
    }

    protected function saveBefore(Area $model, string $type): string
    {
        if ($type == 'add') {
            $province_id = trim($this->request->post('province_id', ''));
            $city_id = trim($this->request->post('city_id', ''));
            if (!$province_id) {
                $model->p_code = '0';
                $model->level = 1;
            } else {
                if (!$city_id) {
                    $model->p_code = $province_id;
                    $model->level = 2;
                } else {
                    $model->p_code = $city_id;
                    $model->level = 3;
                }
            }
            if ($model->p_code == $model->code) {
                return '上级不能为自己';
            }
        }
        return '';
    }

    protected function deleteBefore(Area $model, string $type): string
    {
        $child = AreaService::getListByPCode($model->code);
        if($child) return '该区划下有子区域，无法删除';
        return '';
    }

    public function actionAjaxGetAreaList()
    {
        $p_code = trim($this->request->post('p_code', ''));
        if (!$p_code) return $this->success('', ['list' => []]);
        $list = AreaService::getListByPCode($p_code);
        return $this->success('', ['list' => $list]);
    }
}

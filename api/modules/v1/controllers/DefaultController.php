<?php

namespace api\modules\v1\controllers;


use api\components\BaseController;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends BaseController
{
   public function actionIndex(){

       return $this->returnJson()->b5success();
   }
}

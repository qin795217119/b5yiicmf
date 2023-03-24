<?php

namespace api\modules\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        header("ACCESS-CONTROL-ALLOW-ORIGIN:*");
        header("ACCESS-CONTROL-ALLOW-HEADERS:*");
        header("Access-Control-Request-Method:*");
        // custom initialization code goes here
        parent::init();
    }
}

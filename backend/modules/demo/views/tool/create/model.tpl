<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models{$dir};

/**
 * This is the model class for table "{$table}".
 *
__property__ */
class {$model} extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{$table}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[__rules__], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
__attribute__        ];
    }
__time__
}

<?php

namespace app\models;

use Yii;
use app\components\behaviors\CacheBehavior;

class SomeDataModel extends \yii\db\ActiveRecord
{
    //..............................................

    public function behaviors()
    {
        parent::behaviors();
        return [
            'CacheBehavior' => [
                'class' => CacheBehavior::className(),
                'dependencies' => ['user_id', 'date', 'type']
            ],
        ];
    }

    //..............................................
}

<?php

namespace app\models;

use Yii;
use app\components\behaviors\CacheBehavior;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property int $inn
 * @property string $company
 */
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

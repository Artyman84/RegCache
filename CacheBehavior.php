<?php


namespace app\components\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class CacheBehavior extends Behavior
{

    public $dependencies = [];


    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'deleteCache',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'deleteCache',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteCache',
        ];
    }

    public function deleteCache()
    {
        $model = $this->owner;
        $newValues = [];
        $oldValues = [];

        foreach ($this->dependencies as $dependency) {
            $newValues[] = $model->$dependency;
            $oldValues[] = $model->getOldAttribute($dependency);
        }

        $prefix = $model::className();
        $newKey = $prefix . ':' . implode('_', $newValues);
        $oldKey = $prefix . ':' . implode('_', $oldValues);

        Yii::$app->cache->delete($oldKey);

        if ($oldKey != $newKey) {
            Yii::$app->cache->delete($newKey);
        }
    }
}
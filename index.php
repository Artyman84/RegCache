<?php

$userId = Yii::$app->user->id;
$key = SomeDataModel::className() . ':' . $userId . '_' . $date . '_' . $type;

$data = Yii::$app->cache->getOrSet($key, function() use ($date, $type) {
    $userId = Yii::$app->user->id;
    $dataList = SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
    $result = [];

    if (!empty($dataList)) {
        foreach ($dataList as $dataItem) {
            $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
        }
    }

    return $result;
});
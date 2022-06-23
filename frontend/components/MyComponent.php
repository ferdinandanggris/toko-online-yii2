<?php

namespace frontend\components;

use Yii;
use yii\base\Component;
use frontend\models\Statistic;

class MyComponent extends Component
{
    const USERACCESSVIEW = 'userAccessView';
    public static function statisticHandler()
    {
        $model = new Statistic();
        $model->access_time = date('Y-m-d H:i:s');
        $model->user_ip = Yii::$app->request->userIP;
        $model->user_host = Yii::$app->request->hostInfo;
        $model->path_info = Yii::$app->request->pathInfo;
        $model->query_string = Yii::$app->request->queryString;

        $model->save();
    }
}

<?php

namespace frontend\components;

use Yii;
use yii\helpers\Url;
use yii\base\Component;

class LoginChecker extends Component
{
    const ISLOGIN = 'isLogin';
    public static function loginHandler()
    {
        // the current user identity. `null` if the user is not authenticated.
        $identity = Yii::$app->user->identity;

        // the ID of the current user. `null` if the user not authenticated.
        $id = Yii::$app->user->id;

        // whether the current user is a guest (not authenticated)
        $isGuest = Yii::$app->user->isGuest;

        if (($identity == null) || ($id == null) || ($isGuest)) {
            header('Location: http://localhost/mymart/frontend/web/site/login');
            die;
        }
    }
}

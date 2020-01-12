<?php

namespace app\modules\user\controllers;

use app\models\User;
use app\modules\user\models\InviteForm;
use yii\filters\AccessControl;
use yii\web\Controller;


/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','all'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionAll()
    {
        $users = User::find()->all();
        $inviteModel = new InviteForm();

        return $this->render('all',['users' => $users,'inviteModel' => $inviteModel]);
    }
}
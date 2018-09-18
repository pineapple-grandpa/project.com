<?php

namespace app\modules\user\controllers;

use app\models\User;
use app\modules\user\models\SettingsForm;
use Yii;
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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        return $this->render('index', ['user' => $user]);
    }

    public function actionAll()
    {
        $users = User::find()->all();
        return $this->render('all',['users' => $users]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 8:49
 */

namespace app\modules\user\controllers;


use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex($id)
    {
        $user = User::findIdentity($id);
        return $this->render('index', ['user' => $user]);
    }
}
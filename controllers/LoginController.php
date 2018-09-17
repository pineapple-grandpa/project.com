<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12.09.18
 * Time: 14:52
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use yii\web\Response;

class LoginController extends Controller
{
    /**
     * show login form action
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
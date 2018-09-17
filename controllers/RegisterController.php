<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 13.09.18
 * Time: 11:27
 */

namespace app\controllers;


use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class RegisterController extends Controller
{
    /**
     * show register form action
     *
     * @return string|\yii\web\Response
     */
    public function actionForm()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        return $this->render('register', ['model' => $model]);
    }

    /**
     * register action
     *
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        $model = new RegisterForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->name = $model->name;
            $user->login = $model->login;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->birth_date = $model->birth_date;
            $user->gender = $model->gender;
            if ($user->save()){
                $auth = Yii::$app->authManager;
                $role = $auth->getRole('user');
                $auth->assign($role, $user->getId());
                return $this->goHome();
            }
        }
    }

}
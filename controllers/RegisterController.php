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
use app\services\UserService;
use Yii;
use yii\web\Controller;
use yii\base\Module;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(
        $id,
        Module $module,
        UserService $userService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->userService = $userService;
    }

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
        $user = new User();

        if ($this->userService->saveNew($model,$user)) {
            $this->userService->setRole('user',$user->getId());

            return $this->redirect('/login');
        }

        return $this->redirect('/register/form');

    }

}
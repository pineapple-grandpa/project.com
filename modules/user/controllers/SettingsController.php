<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.09.18
 * Time: 17:00
 */

namespace app\modules\user\controllers;


use app\models\User;
use app\modules\user\models\SettingsForm;
use app\modules\user\models\UploadForm;
use app\modules\user\Module;
use app\services\UserService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SettingsController extends Controller
{
    protected $userService;

    public function __construct(
        $id,
        Module $module,
        UserService $userService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->userService = $userService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','avatar'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = User::findOne(\Yii::$app->user->getId());
        $model = new SettingsForm();
        $settings = $user->settings;

        if ($this->userService->saveChanges($model,$user)) {
            Yii::$app->session->setFlash('success', "Profile updated successfully!");
            return $this->redirect('/user/profile?id=' . $user->id . '&lim=10');
        }

        return $this->render('index', ['user' => $user, 'model' => $model,'settings' => $settings]);
    }

    public function actionAvatar()
    {
        $model = new UploadForm();
        $user = User::findOne(\Yii::$app->user->getId());

        if($this->userService->avatarUpload($model,$user)){
            Yii::$app->session->setFlash('success', "Avatar updated successfully!");
            return $this->redirect('/user/profile?id=' . $user->id . '&lim=10');
        }

        return $this->render('upload', ['model' => $model,'user' => $user]);
    }

}
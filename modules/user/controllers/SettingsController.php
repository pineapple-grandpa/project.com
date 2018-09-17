<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.09.18
 * Time: 17:00
 */

namespace app\modules\user\controllers;


use app\modules\user\models\SettingsForm;
use app\modules\user\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class SettingsController extends Controller
{
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
        $user = \Yii::$app->user->identity;
        $model = new SettingsForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user->name = $model->name;
            $user->email = $model->email;
            $user->gender = $model->gender;
            $user->birth_date = $model->birth_date;

            if ($user->save()) {
                Yii::$app->session->setFlash('success', "Profile updated successfully!");
                return $this->redirect('/user');
            }
        }

        return $this->render('index', ['user' => $user, 'model' => $model]);
    }

    public function actionAvatar()
    {
        $model = new UploadForm();
        $user = \Yii::$app->user->identity;

        if (Yii::$app->request->isPost) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->upload()) {
                $user->avatar = $model->avatarName;
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', "Avatar updated successfully!");
                    return $this->redirect('/user');
                }
            }
        }

        return $this->render('upload', ['model' => $model,'user' => $user]);
    }

}
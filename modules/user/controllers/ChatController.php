<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 10:38
 */

namespace app\modules\user\controllers;


use app\models\User;
use app\modules\user\models\Chat;
use app\modules\user\models\MessageForm;
use yii\web\Controller;

class ChatController extends Controller
{

    public function actionAll()
    {
        $user = User::findOne(\Yii::$app->user->getId());
        $chats = Chat::find()->andWhere(['and','first_user_id' => $user->id,'second_user_id' => $user->id])->orderBy('created_at')->all();

        return $this->render('all',['user' => $user,'chats' => $chats]);
    }

    public function actionDialog($id)
    {
        $chat = Chat::findOne($id);
        $user = User::findOne(\Yii::$app->user->getId());
        $model = new MessageForm();


        return $this->render('dialog',['chat' => $chat,'user' => $user]);
    }

}
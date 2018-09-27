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
use app\modules\user\models\EditMessageForm;
use app\modules\user\models\MessageForm;
use app\modules\user\Module;
use app\modules\user\services\ChatService;
use app\modules\user\services\MessageService;
use Yii;
use yii\web\Controller;

class ChatController extends Controller
{
    protected $messageService;

    protected $chatService;

    /**
     * ChatController constructor.
     * @param $id
     * @param Module $module
     * @param MessageService $messageService
     * @param ChatService $chatService
     * @param array $config
     */
    public function __construct(
        $id,
        Module $module,
        MessageService $messageService,
        ChatService $chatService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->messageService = $messageService;
        $this->chatService = $chatService;
    }

    public function actionAll()
    {
        $user = User::findOne(\Yii::$app->user->getId());
        $chats = Chat::find()->where(['or', ['first_user_id' => $user->id], ['second_user_id' => $user->id]])->all();

        return $this->render('all', ['user' => $user, 'chats' => $chats]);
    }

    public function actionDialog($id)
    {
        $chat = Chat::findOne($id);
        $user = User::findOne(\Yii::$app->user->getId());
        $model = new MessageForm();
        $editMessageModel = new EditMessageForm();

        $companionId = ($chat->first_user_id == $user->id) ? $chat->second_user_id : $chat->first_user_id;
        $companion = User::findOne($companionId);

        if ($this->messageService->save($model)) {
            $this->redirect('/user/chat/dialog?id=' . $id);
        }

        return $this->render('dialog', ['chat' => $chat, 'user' => $user, 'model' => $model, 'companion' => $companion,'editMessageModel' => $editMessageModel]);
    }

    public function actionCreate($id)
    {
        $user = User::findOne(\Yii::$app->user->getId());
        $companion = User::findOne($id);

        $chat = $this->chatService->findChat($user, $companion);

        if (!empty($chat[0])) {

            return $this->redirect('/user/chat/dialog?id=' . $chat[0]->id);

        } else {

            $chat = new Chat();
            if ($this->chatService->save($chat, $user, $companion)) {
                return $this->redirect('/user/chat/dialog?id=' . $chat->id);
            }

            Yii::$app->session->setFlash('error', "Something failed!");
            return $this->redirect('/user/chat/all');
        }
    }

    public function actionEdit()
    {
        return $this->messageService->saveChanges();
    }

}
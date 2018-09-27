<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 15:24
 */

namespace app\modules\user\services;



use app\modules\user\models\EditMessageForm;
use app\modules\user\models\Message;
use app\services\RequestService;

class MessageService
{
    /**
     * @var RequestService
     */
    private $requestService;

    /**
     * CommentService constructor.
     * @param RequestService $requestService
     */
    public function __construct(
        RequestService $requestService
    )
    {
        $this->requestService = $requestService;
    }

    public function save($model)
    {

        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $message = new Message();
            $message->chat_id = $model->chat_id;
            $message->author_id = $model->author_id;
            $message->message = $model->message;

            return $message->save();
        }

        return false;
    }

    public function saveChanges()
    {
        $model = new EditMessageForm();
        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $message = Message::findOne($model->message_id);
            $message->message = $model->message;

            return $message->save();
        }

        return false;
    }


}
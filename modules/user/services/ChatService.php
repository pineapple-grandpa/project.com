<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 18:53
 */

namespace app\modules\user\services;


use app\modules\user\models\Chat;
use app\services\RequestService;

class ChatService
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

    /**
     * @param $chat
     * @param $user
     * @param $companion
     * @return mixed
     */
    public function save($chat, $user, $companion)
    {
        $chat->first_user_id = $user->id;
        $chat->second_user_id = $companion->id;

        return $chat->save();
    }

    /**
     * @param $user
     * @param $companion
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findChat($user, $companion)
    {
        return Chat::find()
            ->where(['and', ['first_user_id' => $user->id], ['second_user_id' => $companion->id]])
            ->orWhere(['and', ['first_user_id' => $companion->id], ['second_user_id' => $user->id]])
            ->all();
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 28.09.18
 * Time: 12:04
 */

namespace app\modules\user\services;


use app\models\Friend;
use app\modules\user\models\InviteForm;
use app\services\RequestService;

class FriendService
{
    protected $requestService;

    public function __construct(
        RequestService $requestService
    )
    {
        $this->requestService = $requestService;
    }

    public function addFriend()
    {
        $model = new InviteForm();

        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $friend1 = new Friend();
            $friend2 = new Friend();

            $friend1->user_id = $model->from_user;
            $friend1->friend_id = $model->to_user;

            $friend2->user_id = $model->to_user;
            $friend2->friend_id = $model->from_user;


            return ($friend1->save() && $friend2->save());
        }

        return false;
    }

    public function getFriendRow($user,$friend)
    {
        return $friendRow = Friend::find()->where(['and',['user_id' => $user,'friend_id' => $friend]])->one();
    }

    public function deleteFriend($user,$friend)
    {
        $row1 = $this->getFriendRow($user,$friend);
        $row2 = $this->getFriendRow($friend,$user);

        return ($row1->delete() && $row2->delete());
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.09.18
 * Time: 18:38
 */

namespace app\modules\user\services;


use app\models\Invite;
use app\modules\user\models\InviteForm;
use app\services\RequestService;

class InviteService
{
    protected $requestService;

    public function __construct(
        RequestService $requestService
    )
    {
        $this->requestService = $requestService;
    }

    public function saveNew()
    {
        $model = new InviteForm();

        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $invite = new Invite();
            $invite->from_user = $model->from_user;
            $invite->to_user = $model->to_user;
            return $invite->save();
        }

        return false;
    }

    public function newInviteByIds($user,$friend)
    {
        $invite = new Invite();
        $invite->from_user = $friend;
        $invite->to_user = $user;

        return $invite->save();
    }

    public function isAlreadyHaveInviteFromThisUser()
    {
        $model = new InviteForm();

        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $invite = Invite::find()->where(['and', ['from_user' => $model->to_user, 'to_user' => $model->from_user]])->all();

            return (!empty($invite[0]));
        }

        return false;
    }

    public function getInviteFromThisUser()
    {
        $model = new InviteForm();

        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $invite = Invite::find()->where(['and', ['from_user' => $model->to_user, 'to_user' => $model->from_user]])->all();

            return $invite[0];
        }

        return false;
    }

    public function inviteDelete($id)
    {
        $invite = Invite::findOne($id);

        return $invite->delete();
    }

    public function getInviteByUsersId($to_user,$from_user)
    {
       $invite = Invite::find()->where(['and',['to_user' => $to_user,'from_user' => $from_user]])->one();
       return $invite;
    }
}

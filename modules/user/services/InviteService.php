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

}

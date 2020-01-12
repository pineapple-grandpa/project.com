<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 28.09.18
 * Time: 13:22
 */

namespace app\modules\user\controllers;


use app\modules\user\Module;
use app\modules\user\services\InviteService;
use yii\filters\AccessControl;
use yii\web\Controller;

class InviteController extends Controller
{
    protected $inviteService;

    public function __construct(
        $id,
        Module $module,
        InviteService $inviteService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->inviteService = $inviteService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['remove'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }


    public function actionRemove($to_user,$from_user)
    {
        $invite = $this->inviteService->getInviteByUsersId($to_user,$from_user);
        return $this->inviteService->inviteDelete($invite->id);
    }



}
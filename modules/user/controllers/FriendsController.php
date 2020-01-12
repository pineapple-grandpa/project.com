<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.09.18
 * Time: 16:00
 */

namespace app\modules\user\controllers;


use app\models\User;
use app\modules\user\models\InviteForm;
use app\modules\user\Module;
use app\modules\user\services\FriendService;
use app\modules\user\services\InviteService;
use yii\filters\AccessControl;
use yii\web\Controller;

class FriendsController extends Controller
{
    protected $inviteService;
    protected $friendService;

    public function __construct(
        $id,
        Module $module,
        InviteService $inviteService,
        FriendService $friendService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->inviteService = $inviteService;
        $this->friendService = $friendService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['all','invite','delete'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionAll()
    {
        $owner = User::findOne(\Yii::$app->user->getId());
        $friends = $owner->getFriends();
        $invitesTo = $owner->getInvitesTo();
        $invitesFrom = $owner->getInvitesFrom();
        $inviteModel = new InviteForm();

        return $this->render('index', ['owner' => $owner, 'friends' => $friends,'invitesTo' => $invitesTo,'invitesFrom' => $invitesFrom,'inviteModel' => $inviteModel]);
    }

    public function actionInvite()
    {
        if ($this->inviteService->isAlreadyHaveInviteFromThisUser()){
            $invite = $this->inviteService->getInviteFromThisUser();
            $this->inviteService->inviteDelete($invite->id);

            return $this->friendService->addFriend();
        } else {

            return $this->inviteService->saveNew();
        }
    }

    public function actionDelete($user,$friend)
    {
        if ($this->friendService->deleteFriend($user,$friend)){
           return $this->inviteService->newInviteByIds($user,$friend);
        }

        return false;
    }
}
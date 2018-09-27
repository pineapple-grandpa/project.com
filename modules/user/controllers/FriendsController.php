<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.09.18
 * Time: 16:00
 */

namespace app\modules\user\controllers;


use app\models\User;
use app\modules\user\Module;
use app\modules\user\services\InviteService;
use yii\filters\AccessControl;
use yii\web\Controller;

class FriendsController extends Controller
{
    protected $inviteService;

    public function __construct(
        $id,
        Module $module,
        InviteService $inviteService,
        array $config = []
    )
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
                        'actions' => ['all',],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionAll()
    {
        $user = User::findOne(\Yii::$app->user->getId());
        $friends = $user->getFriends();

        return $this->render('index', ['user' => $user, 'friends' => $friends]);
    }

    public function actionInvite()
    {
        return $this->inviteService->saveNew();
    }

    public function actionAdd()
    {

    }


}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 13.09.18
 * Time: 17:21
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $moder = $auth->createRole('moder');
        $user = $auth->createRole('user');

        $auth->add($admin);
        $auth->add($moder);
        $auth->add($user);

        $auth->addChild($moder, $user);
        $auth->addChild($admin, $moder);
    }
}
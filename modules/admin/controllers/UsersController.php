<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14.09.18
 * Time: 16:06
 */

namespace app\modules\admin\controllers;


use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
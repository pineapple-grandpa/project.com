<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14.09.18
 * Time: 16:06
 */

namespace app\modules\admin\controllers;


use app\models\User;
use app\modules\admin\models\CreateForm;
use app\modules\admin\models\UpdateForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','update','delete','create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        $model = new UpdateForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user->name = $model->name;
            $user->email = $model->email;
            $user->gender = $model->gender;
            $user->role = $model->role;
            $user->birth_date = $model->birth_date;

            $auth = Yii::$app->authManager;
            $auth->revokeAll($id);
            $role = $auth->getRole($model->role);
            $auth->assign($role,$id);

            if ($user->save()) {
                Yii::$app->session->setFlash('success', "User updated successfully.");
                return $this->redirect('/admin/users');
            }
        }
        return $this->render('update', ['user' => $user, 'model' => $model]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if ($user->delete()) {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($id);
            Yii::$app->session->setFlash('success', "User deleted successfully.");
            return $this->redirect('/admin/users');
        }
    }

    public function actionCreate()
    {
        $model = new CreateForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->name = $model->name;
            $user->login = $model->login;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->birth_date = $model->birth_date;
            $user->gender = $model->gender;
            $user->role = $model->role;
            if ($user->save()){
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($model->role);
                $auth->assign($role, $user->getId());
                Yii::$app->session->setFlash('success', "User created successfully.");
                return $this->redirect('/admin/users');
            }

        }

        return $this->render('create',['model'=>$model]);
    }

}
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
use app\modules\admin\Module;
use app\services\UserService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(
        $id,
        Module $module,
        UserService $userService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->userService = $userService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'create'],
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
        $options = ['role'];

        if (
            $this->userService->saveChanges($model, $user, $options) &&
            $this->userService->revokeRoles($id) &&
            $this->userService->setRole($user->role, $user->id)
        ) {
            Yii::$app->session->setFlash('success', "User updated successfully!");
            return $this->redirect('/admin/users');
        }

        return $this->render('update', ['user' => $user, 'model' => $model]);
    }

    public function actionDelete($id)
    {
        if ($this->userService->delete($id) && $this->userService->revokeRoles($id)) {
            Yii::$app->session->setFlash('success', "User deleted successfully.");
            return $this->redirect('/admin/users');
        }

        Yii::$app->session->setFlash('error', "Failed to delete!");
        return $this->redirect('/admin/users');
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new CreateForm();
        $user = new User();
        $options = ['role'];

        if ($this->userService->saveNew($model, $user, $options) &&
            $this->userService->setRole($user->role, $user->id)
        ) {
            Yii::$app->session->setFlash('success', "User created successfully.");
            return $this->redirect('/admin/users');
        }

        return $this->render('create', ['model' => $model]);
    }

}
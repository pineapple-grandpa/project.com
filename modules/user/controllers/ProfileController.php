<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 8:49
 */

namespace app\modules\user\controllers;


use app\models\Article;
use app\models\User;
use app\modules\user\models\ArticleForm;
use app\modules\user\models\CommentForm;
use app\modules\user\Module;
use app\modules\user\services\ArticleService;
use app\modules\user\services\CommentService;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
    protected $articleService;
    protected $commentService;

    public function __construct(
        $id,
        Module $module,
        ArticleService $articleService,
        CommentService $commentService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->articleService = $articleService;
        $this->commentService = $commentService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex($id,$lim)
    {
        $user = User::findIdentity($id);

        $articles = Article::find()->where(['user_id' => $id])->orderBy(['id' => SORT_DESC])->limit($lim)->all();

        $articleModel = new ArticleForm();
        if ($this->articleService->saveNew($articleModel)){
            return $this->redirect('/user/profile?id=' . $id . '&lim=' . $lim);
        }

        $commentModel = new CommentForm();
        if ($this->commentService->saveNew($commentModel)){
            return $this->redirect('/user/profile?id=' . $id . '&lim=' . $lim);
        }

        return $this->render('index', ['user' => $user,'articles' => $articles, 'model' => $articleModel,'model2' => $commentModel]);
    }
}
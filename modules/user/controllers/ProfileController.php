<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 8:49
 */

namespace app\modules\user\controllers;


use app\models\Article;
use app\models\Comment;
use app\models\User;
use app\modules\user\models\ArticleForm;
use app\modules\user\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
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
        $limit = $lim;
        if (!$limit) {
            $limit = 10;
        }
        $articles = Article::find()->where(['user_id' => $id])->orderBy(['id' => SORT_DESC])->limit($limit)->all();

        $model = new ArticleForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $article = new Article();
            $article->user_id = $id;
            $article->author_id = $model->author_id;
            $article->author_name = $model->author_name;
            $article->author_avatar = $model->author_avatar;
            $article->message = $model->message;
            if ($article->save()){
                return $this->redirect('/user/profile?id=' . $id . '&lim=' . $limit);
            }
        }

        $model2 = new CommentForm();
        if($model2->load(\Yii::$app->request->post()) && $model2->validate()){
            $comment = new Comment();
            $comment->parent_id = $model2->parent_id;
            $comment->author_id = $model2->author_id;
            $comment->author_name = $model2->author_name;
            $comment->author_avatar = $model2->author_avatar;
            $comment->message = $model2->message;
            if ($comment->save()){
                return $this->redirect('/user/profile?id=' . $id . '&lim=' . $limit);
            }
        }

        return $this->render('index', ['user' => $user,'articles' => $articles, 'model' => $model,'model2' => $model2]);
    }
}
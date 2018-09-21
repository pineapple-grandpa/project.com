<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 13:12
 */

namespace app\modules\user\controllers;


use app\models\Article;
use app\modules\user\models\ArticleForm;
use app\modules\user\models\EditArticleForm;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class ArticleController extends Controller
{
    public function actionDelete($id)
    {
        $article = Article::findOne($id);

        if ($article->delete()) {
            return true;
        }
        return false;
    }

    public function actionSave()
    {
        $request = \Yii::$app->getRequest();
        $article = Article::findOne($request->bodyParams['ArticleForm']['article_id']);
        $article->message = $request->bodyParams['ArticleForm']['message'];
        return $article->save();

//        if ($request->isPost && $model->load($request->post())) {
//            \Yii::$app->response->format = Response::FORMAT_JSON;
//            return ['success' => $model->save()];


    }

    public function actionValidate()
    {
        $model = new EditArticleForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        return false;
    }
}
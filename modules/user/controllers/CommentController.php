<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 15:49
 */

namespace app\modules\user\controllers;


use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionDelete($id)
    {
        $article = Comment::findOne($id);

        if ($article->delete()) {
            return true;
        }
        return false;
    }

    public function actionSave()
    {
        $request = \Yii::$app->getRequest();

        if ($request->bodyParams['CommentForm']['comment_id'] && $request->bodyParams['CommentForm']['message']) {
//            var_dump($request->bodyParams);
            $comment = Comment::findOne($request->bodyParams['CommentForm']['comment_id']);
            $comment->message = $request->bodyParams['CommentForm']['message'];
            return $comment->save();
        }

        return false;
    }

}
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

}
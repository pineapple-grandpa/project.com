<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 13:37
 */

namespace app\modules\user\models;


use app\models\Article;
use yii\base\Model;

class EditArticleForm extends Model
{
    public $article_id;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['article_id', 'integer'],
            ['message', 'string'],
        ];
    }

    public function save()
    {
        $article = Article::findOne($this->article_id);
        $article->message = $this->message;
        return $article->save();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 13:37
 */

namespace app\modules\user\models;


use yii\base\Model;

class ArticleForm extends Model
{
    public $author_id;
    public $author_name;
    public $author_avatar;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['author_id','integer'],
            ['author_name', 'string'],
            ['author_avatar', 'string'],
            ['message', 'string'],
        ];
    }
}
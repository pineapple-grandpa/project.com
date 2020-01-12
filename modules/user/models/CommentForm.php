<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 19.09.18
 * Time: 10:16
 */

namespace app\modules\user\models;


use yii\base\Model;

class CommentForm extends Model
{
    public $parent_id;
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
            ['parent_id','integer'],
            ['author_id','integer'],
            ['author_name', 'string'],
            ['author_avatar', 'string'],
            ['message', 'string'],
        ];
    }
}
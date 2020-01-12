<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 15:03
 */

namespace app\modules\user\models;


use yii\base\Model;

class MessageForm extends Model
{
    public $chat_id;
    public $author_id;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['author_id','integer'],
            ['chat_id', 'integer'],
            ['message', 'string'],
        ];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.09.18
 * Time: 11:40
 */

namespace app\modules\user\models;


use yii\base\Model;

class EditMessageForm extends Model
{
    public $message_id;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['message_id','integer'],
            ['message', 'string'],
        ];
    }

}
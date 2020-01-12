<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.09.18
 * Time: 18:51
 */

namespace app\modules\user\models;


use yii\base\Model;

class InviteForm extends Model
{
    public $from_user;
    public $to_user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['from_user','integer'],
            ['to_user','integer']
        ];
    }

}
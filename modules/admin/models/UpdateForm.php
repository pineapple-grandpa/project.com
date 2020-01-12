<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12.09.18
 * Time: 12:15
 */

namespace app\modules\admin\models;

use yii\base\Model;

class UpdateForm extends Model
{
    public $name;
    public $email;
    public $birth_date;
    public $gender;
    public $role;

    public $option_id;
    public $option_value;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email','email'],
            ['name', 'string'],
            ['gender', 'string'],
            ['gender', 'validateGender'],
            ['birth_date', 'string'],
            ['role', 'string'],
            ['role','validateRole'],
            ['option_id', 'integer'],
            ['option_value', 'integer'],
        ];
    }

    /**
     * @return array labels for attributes
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'name' => 'Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth date',
            'role' => 'Role'
        ];
    }

    public function validateGender($attribute, $params)
    {
        $genders = [
            'male',
            'female'
        ];

        if (!in_array($this->gender,$genders)) {
            $this->addError($attribute, "The gender can be 'male' or 'female' !");
        }
    }

    public function validateRole($attribute, $params)
    {
        $roles = [
            'user',
            'moder'
        ];

        if (!in_array($this->role,$roles)) {
            $this->addError($attribute, "The role can be only 'user' or 'moder' !");
        }
    }
}
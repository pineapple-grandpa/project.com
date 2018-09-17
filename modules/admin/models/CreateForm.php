<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12.09.18
 * Time: 12:15
 */

namespace app\modules\admin\models;

use app\models\User;
use yii\base\Model;

class CreateForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $confirm_password;
    public $name;
    public $birth_date;
    public $gender;
    public $role;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password', 'confirm_password'], 'required', 'message' => 'fill in the fields!'],
            ['login', 'unique', 'targetClass' => User::className(), 'message' => 'This login already in use!'],
            ['password', 'validatePassword'],
            ['email', 'email'],
            ['name', 'string'],
            ['gender', 'string'],
            ['gender', 'validateGender'],
            ['birth_date', 'string'],
            ['role', 'string'],
            ['role','validateRole']
        ];
    }

    /**
     * @return array labels for attributes
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'password' => 'Password',
            'confirm_password' => 'Confirm password',
            'email' => 'E-mail',
            'name' => 'Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth date',
            'role' => 'Role'
        ];
    }

    /**
     * method for validate password
     *
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if ($this->password !== $this->confirm_password) {
            $this->addError($attribute, "Fields 'password' and 'confirm password' must coincide!");
        }
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
            'moder',
            'admin'
        ];

        if (!in_array($this->role,$roles)) {
            $this->addError($attribute, "The role can be only 'user','moder' or 'admin'!");
        }
    }
}
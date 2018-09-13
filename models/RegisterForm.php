<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12.09.18
 * Time: 12:15
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $confirm_password;
    public $name;
    public $birth_date;
    public $gender;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['login','password','confirm_password'],'required','message' => 'fill in the fields!'],
            ['login', 'unique', 'targetClass' => User::className(),  'message' => 'This login already in use!'],
            ['password','validatePassword'],
            ['email','email'],
            ['name','string'],
            ['gender','integer'],
            ['birth_date','string'],
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
            'name' => 'Name'
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
}
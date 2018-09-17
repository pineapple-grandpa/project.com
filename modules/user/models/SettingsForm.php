<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.09.18
 * Time: 14:56
 */

namespace app\modules\user\models;


use yii\base\Model;

class SettingsForm extends Model
{
    public $name;
    public $email;
    public $birth_date;
    public $gender;

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
}
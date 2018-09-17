<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.09.18
 * Time: 16:42
 */

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $avatar;
    public $userId;
    public $avatarName;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg'],
            ['userId','integer'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->avatar->saveAs('img/avatars/' . $this->userId . $this->avatar->baseName . '.' . $this->avatar->extension);
            $this->avatarName = $this->userId . $this->avatar;
            return true;
        }
        return false;
    }

}
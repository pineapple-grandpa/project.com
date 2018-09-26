<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 25.09.18
 * Time: 15:32
 */

namespace app\services;

use app\models\User;
use app\modules\user\models\UserSettings;
use Yii;
use yii\web\UploadedFile;

class UserService
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }


    /**
     * @param $model
     * @param $user
     * @param array $options
     * @return bool
     * @throws \yii\base\Exception
     */
    public function saveNew($model, $user, $options = [])
    {
        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $user->name = $model->name;
            $user->login = $model->login;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->birth_date = $model->birth_date;
            $user->gender = $model->gender;

            if ($options) {
                foreach ($options as $value) {
                    $user->$value = $model->$value;
                }
            }

            return $user->save();
        }

        return false;
    }

    /**
     * @param $role
     * @param $userId
     * @return \yii\rbac\Assignment
     * @throws \Exception
     */
    public function setRole($role, $userId)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        return $auth->assign($role, $userId);
    }

    /**
     * @param $id
     * @return bool
     */
    public function revokeRoles($id)
    {
        $auth = Yii::$app->authManager;
        return $auth->revokeAll($id);
    }

    /**
     * @param $id
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete($id)
    {
        $user = User::findOne($id);
        return $user->delete();
    }

    /**
     * @param $model
     * @param $user
     * @param array $options
     * @return bool
     */
    public function saveChanges($model, $user, $options = [])
    {
        if ($model->load($this->requestService->getRequest()->post()) && $model->validate()) {
            $user->name = $model->name;
            $user->email = $model->email;
            $user->gender = $model->gender;
            $user->birth_date = $model->birth_date;

            if ($options) {
                foreach ($options as $value) {
                    $user->$value = $model->$value;
                }
            }

            $option = UserSettings::findOne($model->option_id);
            $option->value = $model->option_value;

            return ($user->save() && $option->save());
        }

        return false;
    }

    public function saveSettingsOptions(){

    }

    /**
     * @param $model
     * @param $user
     * @return bool
     */
    public function avatarUpload($model, $user)
    {
        if ($this->requestService->getRequest()->isPost) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->upload()) {
                $user->avatar = $model->avatarName;
                return $user->save();
            }
        }

        return false;
    }

}
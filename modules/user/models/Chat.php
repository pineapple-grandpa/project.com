<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 10:51
 */

namespace app\modules\user\models;

use yii\db\ActiveRecord;

class Chat extends ActiveRecord
{

    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['chat_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

}
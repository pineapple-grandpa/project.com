<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 18.09.18
 * Time: 11:32
 */

namespace app\models;


use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.09.18
 * Time: 19:11
 */

namespace app\assets;


use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $css = [
        'css/site.css',
        'css/chat.css'
    ];
    public $js = [
        'js/chat.js',
        'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
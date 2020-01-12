<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 24.09.18
 * Time: 15:35
 */

namespace app\assets;


use yii\web\AssetBundle;

class ProfileAsset extends AssetBundle
{
    public $css = [
        'css/site.css',
        'css/profile.css'
    ];
    public $js = [
        'js/profile.js',
        'js/friends.js',
        'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
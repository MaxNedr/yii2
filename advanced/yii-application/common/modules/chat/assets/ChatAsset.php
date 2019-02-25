<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.02.2019
 * Time: 20:01
 */


namespace common\modules\chat\assets;

use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/chat.css'
    ];
    public $js = [
        '/js/chat.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
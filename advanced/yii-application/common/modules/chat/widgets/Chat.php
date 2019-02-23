<?php
namespace common\modules\chat\widgets;

//use common\modules\chat\widgets\assets\ChatAsset;


class Chat extends \yii\bootstrap\Widget
{
    public $port = 8081;
    public function init()
    {
       // ChatAsset::register($this->view);
    }
    public function run()
    {
        $this->view->registerJsVar('wsPort', $this->port);
        return $this->render('chat');
    }
}
<?php
namespace common\modules\chat\widgets;

//use common\modules\chat\widgets\assets\ChatAsset;


use Yii;

class Chat extends \yii\bootstrap\Widget
{
    public $port = 8081;
    public $name = 'user';
    public function init()
    {
       // ChatAsset::register($this->view);
    }
    public function run()
    {
        $this->view->registerJsVar('wsPort', $this->port);
        $this->view->registerJsVar('Name', $this->name);
        return $this->render('chat');
    }
}
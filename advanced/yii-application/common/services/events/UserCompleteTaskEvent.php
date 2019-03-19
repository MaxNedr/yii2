<?php

namespace common\services\events;

class UserCompleteTaskEvent extends \yii\base\Event
{
    public $project;
    public $user;
    public $task;
    public $tester;


}
<?php

namespace common\services\events;

class UserTakeTaskEvent extends \yii\base\Event
{
    public $project;
    public $user;
    public $task;

    /*public function dump(){
        return ['project'=>$this->project->id, 'user'=> $this->user->id, 'role'=>$this->role, 'task'=>$this->task];
    }*/
}
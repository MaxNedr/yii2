<?php

namespace common\services\events;

class AssignRoleEvent extends \yii\base\Event
{
    public $project;
    public $user;
    public $role;

    /*public function dump(){
        return ['project'=>$this->project->id, 'user'=> $this->user->id, 'role'=>$this->role];
    }*/
}
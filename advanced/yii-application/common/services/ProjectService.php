<?php
namespace common\services;


use common\models\Project;
use common\models\User;

class AssignRoleEvent extends \yii\base\Event
{
    public $project;
    public $user;
    public $role;

    /*public function dump(){
        return ['project'=>$this->project->id, 'user'=> $this->user->id, 'role'=>$this->role];
    }*/
}

class ProjectService extends \yii\base\Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';

    /**
     * @param Project $project
     * @param User $user
     * @param $role string
     */
    function assignRole(Project $project, User $user, $role){
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }

}
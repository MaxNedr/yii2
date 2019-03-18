<?php
namespace common\services;


use common\services\events\AssignRoleEvent;
use common\models\Project;
use common\models\User;




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
    /**
     * @param Project $project
     * @param User    $user
     *
     * @return mixed
     */
    public function getRoles(Project $project, User $user){
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }
    /**
     * @param Project $project
     * @param User    $user
     * @param         $role
     *
     * @return bool
     */
    public function hasRole(Project $project, User $user, $role) {
        return in_array($role, $this->getRoles($project, $user));
    }

}
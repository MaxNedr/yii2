<?php


namespace common\services;


use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use Yii;
use yii\base\Component;

class TaskService extends Component
{
    /**
     * @param Project $project
     * @param User $user
     * @return bool
     */
    public function canManage(Project $project, User $user){
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);

    }

    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    public function canTake(Task $task, User $user){
        $accessToTask = Yii::$app->projectService->hasRole(
            Project::findOne($task->project_id),
            $user,
            ProjectUser::ROLE_DEVELOPER);

        return $accessToTask && !$task->executor_id ;
    }
    public function canCompele(Task $task, User $user){

    }
    public function takeTask(Task $task, User $user){

    }
    public function completeTask(Task $task){

    }
}
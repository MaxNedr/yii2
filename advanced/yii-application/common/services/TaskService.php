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
    public function canManage(Project $project, User $user)
    {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);

    }

    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    public function canTake(Task $task, User $user)
    {
        $accessToTask = Yii::$app->projectService->hasRole(
            Project::findOne($task->project_id),
            $user,
            ProjectUser::ROLE_DEVELOPER);

        return $accessToTask && !$task->executor_id;
    }

    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    public function canComplete(Task $task, User $user)
    {
        return $task->executor_id == $user->id && !$task->completed_at;
    }

    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    public function takeTask(Task $task, User $user)
    {
        return $task->started_at = time() && $task->executor_id = $user->id && $task->save();
    }

    public function completeTask(Task $task)
    {
        return $task->completed_at = time() && $task->save();
    }
}
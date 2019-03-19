<?php


namespace common\services;


use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use common\services\events\UserTakeTaskEvent;
use Yii;
use yii\base\Component;

class TaskService extends Component
{
    const EVENT_USER_TAKE_TASK = 'event_user_take_task';

    /**
     * @param Project $project
     * @param User $user
     * @param Task $task
     * @param ProjectUser $projectUser
     */
    function userTakeTask(Project $project, $user, Task $task)
    {

        $event = new UserTakeTaskEvent();
        $event->project = $project;
        $event->user = $user;
        $event->task = $task;
        $event->manager = User::find()->select('email')
            ->innerJoin('project_user pu', 'user.id = pu.user_id')
            ->innerJoin('project', 'project.id = pu.project_id')
            ->andWhere(['pu.role' => 'manager'])
            ->andWhere(['pu.project_id' => $project->id])
            ->one();// не красиво получилось. исправлю. в данный момент так функционирует.
            $this->trigger(self::EVENT_USER_TAKE_TASK, $event);
    }

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
    public function takeTask(Task $task, $user)
    {
        $task->started_at = time();
        $task->executor_id = $user->id;
        return $task->save();
    }

    public function completeTask(Task $task)
    {
        $task->completed_at = time();
        return $task->save();
    }
}
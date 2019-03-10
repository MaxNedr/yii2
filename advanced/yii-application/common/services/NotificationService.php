<?php


namespace common\services;


use common\models\Project;
use common\models\User;
use Yii;
use yii\base\Component;

class NotificationService extends Component
{
    /**
     * @param User $user
     * @param Project $project
     * @param $role string
     */
    public function mailSend( $project, $user, $role)
    {
        $to = $user->email;
        $subject = "New role" . $role;
        $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];
        Yii::$app->emailService->send($to, $subject, $views, $data);
    }
}
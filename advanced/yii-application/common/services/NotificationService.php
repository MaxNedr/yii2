<?php


namespace common\services;


use common\models\Project;
use common\models\User;
use Yii;
use yii\base\Component;

class NotificationService extends Component
{
    /**
     * @param $event
     */
    public function mailSend( $event)
    {

        $to = $event->user->email;
        $subject = "New role" . $event->role;
        $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
        $data = ['user' => $event->user, 'project' => $event->project, 'role' => $event->role];
        Yii::$app->emailService->send($to, $subject, $views, $data);
    }
}
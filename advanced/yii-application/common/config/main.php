<?php


return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'emailService' => ['class' => common\services\EmailService::class],
        'projectService' => [
            'class' => common\services\ProjectService::class,
            'on ' . \common\services\ProjectService::EVENT_ASSIGN_ROLE =>
                function (\common\services\AssignRoleEvent $e) {
                    //Yii::info(\common\services\ProjectService::EVENT_ASSIGN_ROLE,'_');
                    $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
                    $data = ['user' => $e->user, 'project' => $e->project, 'role' => $e->role];
                    Yii::$app->emailService->send($e->user->email, "New role" . $e->role, $views, $data);
                }
        ],
    ],
    'modules' => ['chat' => common\modules\chat\Module::class],
];

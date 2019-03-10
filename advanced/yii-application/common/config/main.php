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
                    Yii::$app->notificationService->mailSend($e->project,$e->user,$e->role);
                }
        ],
    ],
    'modules' => ['chat' => common\modules\chat\Module::class],
];

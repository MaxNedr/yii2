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
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],
        'emailService' => ['class' => common\services\EmailService::class],
        'taskService' => ['class' => common\services\TaskService::class],
        'notificationService' => ['class' => common\services\NotificationService::class],
        'projectService' => [
            'class' => common\services\ProjectService::class,
            'on ' . \common\services\ProjectService::EVENT_ASSIGN_ROLE =>
                function (\common\services\AssignRoleEvent $e) {
                    Yii::$app->notificationService->notificationOfNewRoles($e);
                }
        ],
    ],
    'modules' => [
        'chat' => common\modules\chat\Module::class,
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
];

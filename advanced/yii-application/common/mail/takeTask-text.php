<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $task common\models\Task */
/* @var $project common\models\Project */
/* @var $role common\models\ProjectUser */
?>
Пользователь <?= Html::encode($user->username) ?>
   В проекте <?= $project->title ?>
   Взял в работу <?= $task->title ?>

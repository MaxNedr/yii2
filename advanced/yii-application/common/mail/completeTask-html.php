<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $task common\models\Task */
/* @var $project common\models\Project */
/* @var $role common\models\ProjectUser */
?>
<div >
    <p> Пользователь <?= Html::encode($user->username) ?> </p>
    <p> В проекте <?= $project->title ?></p>
    <p> завершил работу с <?= $task->title ?></p>
</div>


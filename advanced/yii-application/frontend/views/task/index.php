<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearchFrontend */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) */?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
                'attribute' => 'description',
                'value'=>  function ($model) {
                    return mb_substr($model->description, 0, 50);
                },

            ],
            [
                'attribute'=>'creator',
                'content'=>function($model){
                    $creator = \common\models\User::findOne(['id' => $model->creator_id]);
                    return Html::a($creator->username, 'user/' . $creator->id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'creator_id',
                    ArrayHelper::map(
                        \common\models\User::find()->onlyActive()->all(),
                        'id',
                        'username'
                    ),
                    ['prompt' => '', 'class' => 'form-control form-control-sm']
                ),
            ],
            [
                    'attribute'=>'executor',
                'content'=>function($model){
                    $executor = \common\models\User::findOne(['id' => $model->executor_id]);
                    return Html::a($executor->username, 'user/' . $executor->id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'executor_id',
                    ArrayHelper::map(
                            \common\models\User::find()->onlyActive()->all(),
                            'id',
                            'username'
                    ),
                    ['prompt' => '', 'class' => 'form-control form-control-sm']
                ),
            ],
            [
                    'attribute'=>'project title',
                'content'=>function($model){
                    $project = \common\models\Project::findOne(['id' => $model->project_id]);
                    return Html::a($project->title, 'project/' . $project->id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'project_id',
                    ArrayHelper::map(\common\models\Project::find()
                        ->byUser(Yii::$app->user->id)->all(), 'id', 'title'),
                    ['prompt' => '', 'class' => 'form-control form-control-sm']
                ),
            ],
            'started_at:datetime',
            'completed_at:datetime',
            //'updater_id',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {pass}',
                'buttons' => [
                    'take' => function ( \common\models\Task $model) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], ['data' => [
                            'confirm' => 'Do you take task?',
                            'method' => 'post',
                        ]]);
                    },
                    'pass' => function ( \common\models\Task $model) {
                        $icon = \yii\bootstrap\Html::icon('glyphicon glyphicon-saved');
                        return Html::a($icon, ['task/complete', 'id' => $model->id], ['data' => [
                            'confirm' => 'Do you complete task?',
                            'method' => 'post',
                        ]]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function (\common\models\Task $model) {
                        return Yii::$app->taskService
                            ->canManage(
                                    \common\models\Project::findOne($model->project_id),
                                    Yii::$app->user->identity
                            );
                    },
                    'delete' => function (\common\models\Task $model) {
                        return Yii::$app->taskService
                            ->canManage(
                                    \common\models\Project::findOne($model->project_id),
                                    Yii::$app->user->identity
                            );
                    },
                    'take' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                    },
                    'pass' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

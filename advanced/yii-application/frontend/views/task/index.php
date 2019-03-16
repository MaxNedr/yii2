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
            //'executor_id',
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
            //'started_at',
            //'completed_at',
            //'creator_id',
            //'updater_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(
        [
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
            ],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList([\common\models\Project::STATUS_LABELS]) ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, \common\models\Project::RELATION_PROJECT_USERS)
            ->widget(MultipleInput::class, [
                // https://github.com/unclead/yii2-multiple-input
                'id' => 'project_users_role_widget',
                'max' => 10,
                'min' => 0,
                'columns' => [
                    [
                        'name' => 'project_id',
                        'type' => 'hiddenInput',
                        'defaultValue' => $model->id,
                    ],
                    [
                        'name' => 'user_id',
                        'title' => 'User name',
                        'type' => 'dropDownList',
                        'items' => $data,
                    ],
                    [
                        'name' => 'role',
                        'title' => 'Role',
                        'type' => 'dropDownList',
                        'items' => \common\models\ProjectUser::ROLE_LABELS,
                    ],
                ],
            ]);
        ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

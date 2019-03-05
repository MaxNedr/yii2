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

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'updater_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'users')->widget(MultipleInput::className(), [
            'max' => 4,
            'columns' => [
                [
                    'name'  => 'user_id',
                    'type'  => 'dropDownList',
                    'title' => 'Users',
                    'defaultValue' => 1,
                    'items' => (new common\models\User)->findAllUsernames()

                ], [
                    'name' => 'role',
                    'title' => 'Role',
                    'type' => 'dropDownList',
                    'items' => \common\models\ProjectUser::ROLE_LABELS,
                ],

            ]
        ]);
        ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

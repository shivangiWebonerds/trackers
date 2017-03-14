<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IssuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issues-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'raised_by') ?>

    <?php // echo $form->field($model, 'raised_date') ?>

    <?php // echo $form->field($model, 'completion_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'loclat') ?>

    <?php // echo $form->field($model, 'loclong') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'dept') ?>

    <?php // echo $form->field($model, 'vote') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

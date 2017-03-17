<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Issues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issues-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Create Issues</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'raised_by')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'raised_date')->textInput() ?>

                    <?= $form->field($model, 'image')->fileInput() ?>
                    
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'loclat')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'loclong')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'dept')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'vote')->textInput() ?>

                    <?= $form->field($model, 'completion_date')->textInput() ?>
                                    
                </div>                
            </div>
            <div class="row">
                <div class="col-md-offset-5 col-md-2">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    
    
    <?php ActiveForm::end(); ?>

</div>

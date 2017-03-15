<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

 

<?php $form = ActiveForm::begin([
        'action' => ['comments/create'],
        'method' => 'post',
    ]); ?>
 <div class="row">
	<div class="col-md-8">
		<?php echo $form->field($model, 'issue_id')->hiddenInput(['value' => $issue->id])->label(false) ?>

	    <?php //echo $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    	<?= $form->field($model, 'msg')->textarea(['rows' => 2, 'placeholder'=>'Enter Comment Here'])->label(false) ?>

	</div>
	<div class="col-md-2">
	<div>&nbsp;</div>
		<input type="submit" value="Add Comment" class="btn btn-success">
	</div>
</div>
<?php ActiveForm::end(); ?>

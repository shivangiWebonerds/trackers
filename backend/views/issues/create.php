<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Issues */

$this->title = 'Create Issues';
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issues-create">

    <!-- <h1><?php//echo Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
 use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Issues */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issues-view container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
            //'data' => [
              //  'confirm' => 'Are you sure you want to delete this item?',
                //'method' => 'post',
            //],
        //]) ?>
    </p>
    <div>&nbsp;</div>
    <div class="row">
        <div>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-4">
        
            <img src="../../public_html/images/issues/<?= $model->image ?>" alt="issue image" style="width: 380px;
    height: 444px;" class="img-thumbnail">
        </div>
        <div class="col-md-6">
                

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'title',
                        'description',
                        'mobile',
                        'raised_by',
                        'raised_date',
                        'completion_date',
                        'status',
                        'loclat',
                        'loclong',
                        'image',
                        'dept',
                        'vote',
                        // 'created_at',
                        // 'created_by',
                        // 'updated_at',
                        // 'updated_by',
                        // 'is_deleted',
                    ],
                ]) ?>            
        </div>
        
    </div>

     <?php
     // echo DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'id',
    //         'title',
    //         'description',
    //         'mobile',
    //         'raised_by',
    //         'raised_date',
    //         'completion_date',
    //         'status',
    //         'loclat',
    //         'loclong',
    //         'image',
    //         'dept',
    //         'vote',
    //         // 'created_at',
    //         // 'created_by',
    //         // 'updated_at',
    //         // 'updated_by',
    //         // 'is_deleted',
    //     ],
    // ]) 
     ?>

</div>
<div class="container-fluid">
    <div class="row">
            <h1>MAP</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d242117.68137725056!2d73.7225356482112!3d18.52489016819215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf2e67461101%3A0x828d43bf9d9ee343!2sPune%2C+Maharashtra!5e0!3m2!1sen!2sin!4v1489568128699" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div>&nbsp;</div>

    <div class="">

        <h1>Comments on issues of  <?= $model->title?> </h1>
        <!-- <a class="btn btn-primary" href="<?php //echo Url::toRoute(['comments/index','id'=>$model->id]);?>">View comment</a> -->
        <div class="row">
            <div class="col-md-10">
                <?php 
                    if(!empty($comments))
                    {
                ?>   
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Date</th>    
                            </tr>
                        </thead>
                        <tbody>
                <?php  
                    foreach ($comments as $comment) {
                ?>
                    
                        
                            <tr>
                                <?php $user=$comment->users;?>
                                <td><?= $comment->type?></td>
                                <td><?= $user->username?></td>
                                <td><?= $comment->msg?></td>
                                <td><?= $comment->comment_date?></td>
                            </tr>
                        
                
                        <!-- echo "<br>";
                        //print_r($comment);
                        echo "msg :".$comment->msg; -->
                <?php
                    }
                ?>
                    </tbody>
                    </table>
                <?php    
                    }
                    else{
                        echo "<h3 class='text-center text-danger'>No Comments Are Available...!!!</h3>";
                    }
                ?>
            </div>
       </div> 
    </div>

    <div>
        <?php echo Yii::$app->CommentView->welcome($model);?>
    </div>
</div>


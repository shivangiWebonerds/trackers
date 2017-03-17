<?php
    use yii\helpers\Url;
?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <img src="../public_html/images/issues/<?= $model->image?>" alt="img" style="height: 255px; width: 100%;" class="thumbnail">
        </div>  
        <div class="col-md-offset-1 col-md-7" >
            <div class="row">
                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Title </b></h5>
                    </div>
                     <div class="col-md-1">
                         <b> : </b>
                     </div>   
                    <div class="col-md-8">
                        <?=$model->title;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Status </b></h5>
                    </div>
                    <div class="col-md-1">
                         <b> : </b>
                     </div>
                    <div class="col-md-8">
                       <?=$model->status;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Department </b></h5>
                    </div>
                    <div class="col-md-1">
                         <b> : </b>
                     </div>
                    <div class="col-md-8">
                       <?=$model->dept;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Raised By </b></h5>
                    </div>
                    <div class="col-md-1">
                         <b> : </b>
                     </div>
                    <div class="col-md-8">
                       <?=$model->raised_by;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Raised At </b></h5>
                    </div>
                    <div class="col-md-1">
                         <b> : </b>
                     </div>
                    <div class="col-md-8">
                       <?=$model->created_at;?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Votes </b></h5>
                    </div>
                    <div class="col-md-1">
                         <b> : </b>
                     </div>
                    <div class="col-md-8">
                       <?=$model->vote;?>
                    </div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <h5><a href="<?php echo Url::toRoute(['site/issue-view','id'=>$model->id]);?>" class="btn btn-primary btn-block">View Details</a></h5>
                </div>
                <div class="col-md-3">
                    <h5><a href="<?php echo Url::toRoute(['site/vote','id'=>$model->id]);?>" class="btn btn-success btn-block">Vote</a></h5>
                </div>
            </div>
            
        </div>
    </div>
    <div>&nbsp;</div>
</div>

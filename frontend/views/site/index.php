<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Tracking Public Issues';
?>
<div class="site-index" style="background-image: url('../public_html/images/home/img2.jpg'); background-repeat: no-repeat; background-size: cover; height: 500px;" >

    <div class="jumbotron" style="color:grey">
        <h1>Welcome!</h1>

        <p class="lead">TO TRACKING PUBLIC ISSUSES.</p>


        <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute('site/submit-issue');?>">Submit your issue</a></p>
    </div>

    <div class="body-content">

        

    </div>
</div>

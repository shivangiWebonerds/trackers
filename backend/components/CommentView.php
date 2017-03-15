<?php
namespace backend\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Comments; 
 
class CommentView extends Component
{
	 public function welcome($issue)
	 {
	 	//print_r($issue);exit;
	 	$comments = new Comments(); 
	 	return Yii::$app->controller->renderPartial("/issues/comment_view",['model'=>$comments,'issue'=>$issue]);
	 }
 
}
?>
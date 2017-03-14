<?php
namespace backend\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\IssuesSearch; 
 
class CommentView extends Component
{
	 public function welcome()
	 {
	 	$IssuesSearch = new IssuesSearch(); 
	 	return Yii::$app->controller->renderPartial("/profile/search_by_id",['model'=>$ProfileSearch]);
	 }
 
}
?>
<?php

namespace backend\modules\api\controllers;

use yii;
use yii\rest\ActiveController;
use yii\web\Response;
use common\models\Issues;
use yii\filters\VerbFilter;

class IssuesController extends ActiveController
{
	public $modelClass='common\models\Issues';//Users class must be exist in common/models
 

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;//convert data into json format 
		
		$behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
    	];

    	$behaviors['verbs'] = [
                'class' => VerbFilter::className(),
                'actions' => [
					   'index' => ['GET', 'HEAD'],
			        'view' => ['GET', 'HEAD'],
			        'create' => ['POST'],
			        'update' => ['PUT', 'PATCH'],
			        'delete' => ['DELETE'],
                ],
            ];

		return $behaviors;
	}

   public function actionList(){

   	$issueList = []; 

   	

   	foreach (Issues::find()->with('comments')->all() as $issue) {
   		$issue->commentList = $issue->comments;
   		$issueList[] = $issue; 
   	}

   	return $issueList;
//   	return Issues::find()->with('comments')->all(); 

   }


}

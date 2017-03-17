<?php

namespace backend\modules\api\controllers;

use yii;
use yii\rest\ActiveController;
use yii\web\Response;
use common\models\User;


class UserController extends ActiveController
{
	public $modelClass='common\models\User';//Users class must be exist in common/models
 

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;//convert data into json format 
		
		$behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
    	];

		return $behaviors;
	}
	
    public function actionIndex()
    {
        return $this->render('index');
    }

}

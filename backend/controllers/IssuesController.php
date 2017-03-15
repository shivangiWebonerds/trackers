<?php

namespace backend\controllers;

use Yii;
use common\models\Issues;
use common\models\IssuesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * IssuesController implements the CRUD actions for Issues model.
 */
class IssuesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','update','delete','logout'],
                'rules' => [
                    [
                        'actions' => ['index','create','view','update','delete','logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Issues models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IssuesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Issues model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Issues();
        //print_r($dataProvider);

        $issues=Issues::findOne($id);
        $comments=$issues->comments;
        
        // foreach ($comments as $c) {
        //     echo "msg :".$c->msg."<br>";
        // }
        // exit;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'comments'=>$comments,
        ]);
    }

    /**
     * Creates a new Issues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Issues();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at=date('Y-m-d');
            $model->created_by=Yii::$app->user->identity->id;

            $imageName = "issue_image_".rand();
               $model->image = UploadedFile::getInstance($model,'image');

               if(!empty($model->image))
                {
                                                
                       $model->image->saveAs('../../frontend/web/images/issues/'.$imageName.'.'.$model->image->extension);
                       $model->image = $imageName.'.'.$model->image->extension;
                       // echo "image: ".$model->image;exit;     
                      $model->save(false);

                    return $this->redirect(['view', 'id' => $model->id]); 
                }
                else
                {
                       
                     $model->image = 'default_issue.png';                            
                     $model->save(false);
                    return $this->redirect(['view', 'id' => $model->id]); 
               }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Issues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $eid=Issues::find()->where(['id'=>$id])->one();
        $model = $this->findModel($eid['id']);
        $image = $model['image'];
        //$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $imageName = "issue_image_".rand();
           $model->image = UploadedFile::getInstance($model,'image');

           if(!empty($model->image)){
                $model->image->saveAs('../../frontend/web/images/issues/'.$imageName.'.'.$model->image->extension);
                  echo $imageName.'.'.$model->image->extension;
                   $model->image = $imageName.'.'.$model->image->extension;
                   $model->save();
            }else{
                

                $model->image = $image;
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Issues model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=Issues::findOne($id);
        $model->is_deleted=1;
        $model->save(false);

        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Issues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Issues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Issues::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

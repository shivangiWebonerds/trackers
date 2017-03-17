<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Issues;
use common\models\Comments;
use common\models\Votes;
use common\models\IssuesSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','submit-issue','comment','vote'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','submit-issue','comment','vote'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionVote($id)
    {
        $model=new Votes();
        $userid=Yii::$app->user->identity->id;
        echo "issue= ".$id ." user= ".$userid;

        $vote=Votes::find()->where(['user'=>$userid])->andWhere(['issue_id'=>$id])->all();
        //Profiles::find()->where([['user'=>$userid])->andWhere(['issue_id'=>$id])->all();
        //echo "<br>vote ".$vote;
        //print_r($vote);
        if(!empty($vote))
        {
            Yii::$app->session->setFlash('success', "You have already voted for this issue...!!!");
                Yii::$app->response->redirect(['site/issues']);
        }
        else
        {
            $model->user=$userid;
            $model->issue_id=$id;
            $model->created_at=date('Y-m-d');
            print_r($model);
            $issues=Issues::findOne($id);
            $issues->vote=$issues->vote+1;
            echo "<br>vote= ".$issues->vote;
            $model->save(false);
            $issues->save(false);
            if($model->save(false) && $issues->save(false))
            {
                Yii::$app->session->setFlash('success', "You have voted successfully...!!!");
                Yii::$app->response->redirect(['site/issues']);       
            }
        }
    }


    public function actionIssues()
    {
        $searchModel = new IssuesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //echo"<pre>";print_r($dataProvider);exit;
        return $this->render('issue_list', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actionComment()
    {
        $model = new Comments();


        if ($model->load(Yii::$app->request->post()) ) {
            $issues=Issues::findOne($model->issue_id);
            $id=$model->issue_id;
            // print_r($issues);
            // print_r($model);
            // echo" <br>id : ".Yii::$app->user->identity->id; 
            // exit;
            $model->type=$issues->title;
            $model->user=Yii::$app->user->identity->id;
            $model->comment_date=date('Y-m-d');
            $model->created_at=date('Y-m-d');
            $model->created_by=Yii::$app->user->identity->id;
            // print_r($model);exit;
            // echo" issue ID :".$model->issue_id; echo" Message :".$model->msg;exit;
            $model->save(false);
            if($model->save(false)){
                Yii::$app->session->setFlash('success', "Comment Added Successfully...!!!");
                Yii::$app->response->redirect(['site/issue-view', 'id' => $id]);    
            }

            
        } else {
            echo"in else";exit;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionIssueView($id)
    {
        $model = new Issues();
        //print_r($dataProvider);

        $issues=Issues::findOne($id);
        $comments=$issues->comments;
        
        // foreach ($comments as $c) {
        //     echo "msg :".$c->msg."<br>";
        // }
        // exit;

        return $this->render('issue_view', [
            'model' => $this->findModel($id),
            'comments'=>$comments,
        ]);
        
    }

    protected function findModel($id)
    {
        if (($model = Issues::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            //echo "is guest";exit;
            return $this->goBack();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //echo "fill up form";exit;
            return $this->goBack();
        } else {
            //echo "not guest";exit;
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionSubmitIssue()
    {
        
       
                    $model = new Issues();
                 if ($model->load(Yii::$app->request->post())) {
                    $model->created_at=date('Y-m-d');
                    $model->created_by=Yii::$app->user->identity->id;

                    $imageName = "issue_image_".rand();
                       $model->image = UploadedFile::getInstance($model,'image');

                       if(!empty($model->image))
                        {
                                                        
                               $model->image->saveAs('../web/images/issues/'.$imageName.'.'.$model->image->extension);
                               $model->image = $imageName.'.'.$model->image->extension;
                               // echo "image: ".$model->image;exit;     
                              $model->save(false);
                              if($model->save(false)){
                                        Yii::$app->session->setFlash('success', "submit issue successfully...!!!");
                                        Yii::$app->response->redirect(['site/index']);    
                                }

                            // return $this->redirect(['view', 'id' => $model->id]); 
                        }
                        else
                        {
                               
                             $model->image = 'default_issue.png';                            
                             $model->save(false);
                             if($model->save(false)){
                                        Yii::$app->session->setFlash('success', "Submit Your Issue Successfully...!!!");
                                        Yii::$app->response->redirect(['site/index']);    
                                }
                            // return $this->redirect(['view', 'id' => $model->id]); 
                       }
                    //return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('submit_issue', [
                        'model' => $model,
                    ]);
                }
        // if (!Yii::$app->user->isGuest)  {
        // }else{
        //     $model = new LoginForm();

        //     return $this->redirect(['login']);
        // }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}

<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\Pages;
use app\models\ProjectSearch;
use frontend\models\Bahasa;
use hscstudio\mimin\components\Mimin;
use app\models\City;
use app\models\Perusahaan;
use yii\web\UploadedFile;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','profile'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','profile'],
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
     * {@inheritdoc}
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

     public function actionProfile()
    {
        /*if(Yii::$app->user->isGuest) {
            $this->redirect(['site/index']);
            die();
        }*/
        $request = Yii::$app->request;
        $do=Perusahaan::findOne(['id_user'=>Yii::$app->user->identity->id]);
        if(!isset($do)){
            $model = new Perusahaan();  
        } else {
            $model=Perusahaan::findOne(['id_user'=>Yii::$app->user->identity->id]);
        }

        if ($model->load($request->post())) {
             $model->logo = UploadedFile::getInstance($model, 'logo');
                if(isset($model->logo)){
                $namafile=rand(1000, 99999999);
                if(strpos(" jpg jpeg bmp gif png ",strtolower($model->logo->extension))){                
                    $file1= $namafile . '.' . $model->logo->extension;
                    $model->logo->saveAs('images/' . $namafile . '.' . $model->logo->extension,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $model->logo->saveAs('images/' . $file1,TRUE);

                }
                $model->logo=$file1;
                }
                $model->id_user=Yii::$app->user->identity->id;
                $model->save();
                //return $this->redirect(['view', 'id' => $model->id]);
            } 
        
        return $this->render('profile', [
                    'model' => $model,
                ]);
       
    }
    public function actionIndeks($id)
    {
        $hasil=Pages::findOne(['slug'=>$id,'status'=>1]);
        if(isset($hasil)){
        $this->layout="single";

         return $this->render('indeks',['hasil'=>$hasil]);
        } else {
        $this->layout="single3";
        return $this->render('indeks');
        }
    }
    public function actionIndeks2($id)
    {
        $hasil=Pages::findOne(['slug'=>$id]);
        if(isset($hasil)){
        $this->layout="single";
        return $this->render('indeks',['hasil'=>$hasil]);
        } else {
        $this->layout="single3";
        return $this->render('indeks');
        }
    }
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
        $this->layout="single2";
        return $this->render('indeks');
        } else {
            if(Mimin::checkRoute('userk/create')){

                return $this->render('index');
            } else {
                $model = new ProjectSearch;
                $request = Yii::$app->request;
                if($model->load($request->post())){

                    return $this->render('indexmember',['model'=>$model]);
                }
                return $this->render('indexmember',['model'=>$model]);

            }
        }
    }
    public function actionBahasa(){
        $model=new Bahasa();
        if($model->load(Yii::$app->request->post())) {
            Yii::$app->session['lang']=$model->bahasa;
            Yii::$app->language=$model->bahasa;
            return $this->goHome();
        }
        else
        {
        Yii::$app->language=Yii::$app->session['lang'];
        
        if(isset(Yii::$app->session['lang'])){
            $model->bahasa=Yii::$app->session['lang'];
        }else{
            $model->bahasa="en";
            Yii::$app->session['lang']="en";
        }
        return $this->render('bahasa',['model'=>$model]);
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
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
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
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please wait for administrator approval');
            //return $this->goHome();
            return $this->redirect(['site/login']);
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

    public function actionKota($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = Yii::$app->db->createCommand("select id, name AS text from city where name like '%".$q."%' limit 20")
            ->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
        }
        return $out;
    }
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
        } catch (InvalidArgumentException $e) {
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

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}

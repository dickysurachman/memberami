<?php

namespace frontend\controllers;

use app\models\User;
use app\models\Barang;
use app\models\Level;
use app\models\Barangpo;
use app\models\Costumer;
use app\models\Project;
use app\models\Barangpodetail;
use app\models\BarangpoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BarangpodetailSearch;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BarangpoController implements the CRUD actions for Barangpo model.
 */
class BarangpoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Barangpo models.
     *
     * @return string
     */


    
    public function actionIndex()
    {
        $searchModel = new BarangpoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;
        if(isset(\Yii::$app->session['lang'])) \Yii::$app->language=\Yii::$app->session['lang'];
        return true ;
    }

    /**
     * Displays a single Barangpo model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        $searchModel = new BarangpodetailSearch();
        $searchModel->id_kode=$id;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPrint($id)
    {
        $model=$this->findModel($id);
        if(isset($model)){
            $this->layout=false;
            return $this->render('print', [
                'model' => $model,
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
            ]);

        }
    }

    /**
     * Creates a new Barangpo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Barangpo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $cek=Costumer::findOne($model->id_perusahaan);
                $model->id_user=$cek->id_user;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
     public function actionProject($id)
    {
        $model = new Barangpo();

        $cek=Project::findOne($id);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->id_perusahaan=$cek->id_costumer;
                $model->id_project=$cek->id;
                $model->id_user=$cek->id_user;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('createproject', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Barangpo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Barangpo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Barangpo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Barangpo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Barangpo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreatepo($id)
    {
        $request = \Yii::$app->request;
        $model = new Barangpodetail();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> \Yii::t('yii2-ajaxcrud', 'Create New')." ".\Yii::t('yii', 'Purchase Orders'),
                    'content'=>$this->renderAjax('_forma', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(\Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $po =Project::findOne($id);
                if(isset($po)) {
                $userd=User::findOne($po->id_user);    
                $user=Level::findOne($userd->id_level);
                if(isset($user)) {
                    $barang=Barang::findOne($model->id_barang);
                    if(isset($barang)) {
                        $model->harga_d=$barang->harga;
                        $model->harga_m=$barang->harga - ($barang->harga * $user->diskon/100);
                    }
                }
                }
                $model->id_kode=$id;
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> \Yii::t('yii2-ajaxcrud', 'Create New')." ".\Yii::t('yii', 'Purchase Orders'),
                    'content'=>'<span class="text-success">'.\Yii::t('yii2-ajaxcrud', 'Create').' '.\Yii::t('yii', 'Purchase Orders').\Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(\Yii::t('yii2-ajaxcrud', 'Create More'), ['createpo','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> \Yii::t('yii2-ajaxcrud', 'Create New')." ".\Yii::t('yii', 'Purchase Orders'),
                    'content'=>$this->renderAjax('_forma', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(\Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }
    }

    /**
     * Updates an existing Barangpodetail model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatepo($id)
    {
        $request = \Yii::$app->request;
        $model = $this->findModelpo($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> \Yii::t('yii2-ajaxcrud', 'Update')." ".\Yii::t('yii', 'Purchase Orders')." #".$id,
                    'content'=>$this->renderAjax('_forma', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(\Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                $po =Project::findOne($model->id_kode);
                if(isset($po)) {
                $userd=User::findOne($po->id_user);    
                $user=Level::findOne($userd->id_level);
                if(isset($user)) {
                    $barang=findOne($model->id_barang);
                    if(isset($barang)) {
                        $model->harga_d=$barang->harga;
                        $model->harga_m=$barang->harga - ($barang->harga * $user->diskon/100);
                    }
                }
                }
                //$model->id_kode=$id;
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> \Yii::t('yii', 'Purchase Orders')." #".$id,
                    'content'=>$this->renderAjax('viewpo', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(\Yii::t('yii2-ajaxcrud', 'Update'), ['updatepo','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> \Yii::t('yii2-ajaxcrud', 'Update')." ".\Yii::t('yii', 'Purchase Orders')." #".$id,
                    'content'=>$this->renderAjax('_forma', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(\Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }
    }

    /**
     * Delete an existing Barangpodetail model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionViewpo($id)
    {   
        $request = \Yii::$app->request;
        if($request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> \Yii::t('yii', 'Purchase Orders')." #".$id,
                    'content'=>$this->renderAjax('viewpo', [
                        'model' => $this->findModelpo($id),
                    ]),
                    'footer'=> Html::button(\Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(\Yii::t('yii2-ajaxcrud', 'Update'), ['updatepo','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }
    }

    
    public function actionDeletepo($id)
    {
        $request = \Yii::$app->request;
        $this->findModelpo($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }
    }
    protected function findModelpo($id)
    {
        if (($model = Barangpodetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

<?php

namespace frontend\controllers;

use Yii;
use app\models\Barang;
use app\models\BarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use frontend\models\Csv;
use yii\web\UploadedFile;
/**
 * BarangController implements the CRUD actions for Barang model.
 */
class BarangController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Barang models.
     * @return mixed
     */
      public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;
        if(isset(Yii::$app->session['lang'])) Yii::$app->language=Yii::$app->session['lang'];
        return true ;
    }
    public function actionIndex()
    {    
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploadcsv()
    {
        $model= new Csv();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->csv = UploadedFile::getInstance($model, 'csv');
            if(isset($model->csv)){
                $namafile=rand(1000, 99999999);
                $file1= $namafile . '.' . $model->csv->extension;
                $model->csv->saveAs('images/' . $namafile . '.' . $model->csv->extension,TRUE);
                $csvFilePath = "images/".$file1;
                $file = fopen($csvFilePath, "r");
                $i=0;
                $i2=0;
                $j=0;
                $transaction = Yii::$app->db->beginTransaction();
                try
                {
                if(isset($model->alamat) and trim($model->alamat)<>"" and is_null($model->alamat)==false) {
                while (($row = fgetcsv($file,0,$model->alamat)) !== FALSE) {
                        $i++;
                        if($i>1) {
                        $i2++;

                       // echo $i.$row[0].$row[1].preg_replace('/[[:^print:]]/', '',$row[2]).str_replace(".","",$row[3])."<br>";
                        ///*
                        
                        $barang = New Barang();
                        $str = preg_replace('/[[:^print:]]/', '',$row[0]);
                        $str = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
                        $str = str_replace("\"", "", $str);
                        $desc =str_replace("\"","",$row[2]);
                        //$desc=str_replace(","," ",$desc);
                        $ammount= str_replace("\"","",$row[3]);
                        $ammount= str_replace(".","",$ammount);
                        $ammount= str_replace(",","",$ammount);
                        $barang->kode = $str;
                        $barang->nama = $row[1];
                        $barang->ukuran =  $desc;
                        $barang->harga = $ammount;
                        $barang->stok_awal=0;
                        $barang->id_perusahaan=0;
                        $barang->id_toko=0;
                        $barang->status=0;
                        $barang->save();   // */
                        
                        }
                }

                //die();
                } else {

                while (($row = fgetcsv($file)) !== FALSE) {
                        $i++;
                        if($i>1) {
                        $i2++;
                        $barang = New Barang();
                        $str = preg_replace('/[[:^print:]]/', '',$row[0]);
                        $str = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
                        $str = str_replace("\"", "", $str);
                        $desc =str_replace("\"","",$row[2]);
                        //$desc=str_replace(","," ",$desc);
                        $ammount= str_replace("\"","",$row[3]);
                        $ammount= str_replace(".","",$ammount);
                        $ammount= str_replace(",","",$ammount);                        
                        $barang->kode = $str;
                        $barang->nama = $row[1];
                        $barang->ukuran =  $desc;
                        $barang->harga = $ammount;
                        $barang->stok_awal=0;
                        $barang->id_perusahaan=0;
                        $barang->id_toko=0;
                        $barang->status=0;
                        $barang->save();  
                        }  
                }
                }                    
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', $i2.' rows Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }

              }
            return $this->redirect(['barang/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsv', [
        'model' => $model,
        ]);

    }


    /**
     * Displays a single Barang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Barang #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

     public function actionCari($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = Yii::$app->db->createCommand("select id,nama AS text from barang where nama like '%".$q."%'  limit 20")
            ->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Barang::find($id)->nama];
        }
        return $out;
    } 

    /**
     * Creates a new Barang model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Barang();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." ". Yii::t('yii', 'Commodity'),
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." ". Yii::t('yii', 'Commodity'),
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' '. Yii::t('yii', 'Commodity').Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." ". Yii::t('yii', 'Commodity'),
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Barang model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." ". Yii::t('yii', 'Commodity')." #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Barang #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update'). Yii::t('yii', 'Commodity')." #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Barang model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Barang model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Barang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Barang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Barang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

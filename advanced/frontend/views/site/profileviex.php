<?php
use yii\helpers\Html;
use yii\web\View;
use app\models\User;
use app\models\Perusahaan;
use yii\widgets\DetailView;
//$url = \yii\helpers\Url::to(['site/kota']);
$this->title=\Yii::t('yii', 'Profile');
//$cityDesc =empty($model->id_kota) ? '' : City::findOne(['id'=>$model->id_kota])->name;
/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
/* @var $form yii\widgets\ActiveForm */


        $ban="";
        $check=false;
        $do=Perusahaan::findOne(['id_user'=>Yii::$app->user->identity->id]);
        if(!isset($do)){
            $check=false;
        } else {
            $model=Perusahaan::findOne(['id_user'=>Yii::$app->user->identity->id]);
            $ban=$model->logo;
            $check=true;
        }


?>
 

<div class="perusahaan-form">

    <div class="row">
        <div class="col-4" style="padding:25px;" align="center"> 
        <?php  

        if($check==true){
         $images=Yii::$app->homeUrl."/images/".$model->logo;
         echo "<img src='".$images."' style='width:210px;'/>";    
        }
        ?>
        <br/>
        <br/>
        <br/>
         <?= Html::a(Yii::t('yii', 'Update'), ['site/profileedit'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-8">
        <?php  
        if($check==true) {
            ?>
         <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nama',
                [
                    'attribute'=>'id_user',
                    'label'=>\Yii::t('yii', 'Level Patner'),
                    'value'=>isset($model->user->level)?$model->user->level->nama:'',
                ],
                'telp_c',
                'nama_d',
                'telp',
                'email',
                'npwp',
                'alamat',
                'nama_s',
                'telp_s',
                'email_s',
                [
                    'attribute'=>'id_user',
                    'label'=>\Yii::t('yii', 'Long Time Joined'),
                    'value'=>isset($model->user)?$model->user->lama:'',
                ],
                
            ],
        ]) ?>
        <?php } ?>
            
        </div>
       

    </div>

   
    
</div>

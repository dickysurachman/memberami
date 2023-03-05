<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\models\City;
use kartik\file\FileInput;
use app\models\User;
$url = \yii\helpers\Url::to(['site/kota']);
$this->title=\Yii::t('yii', 'Update')." ".\Yii::t('yii', 'Profile');
use yii\widgets\DetailView;
use app\models\Perusahaan;
/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-view">
    <?php
        //var_dump($ass);
        $do=Perusahaan::findOne(['id_user'=>$model->id]);
    ?>
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'label'=> 'Created At',
                'attribute'=>'created_at',
                 'format' => ['date', 'php:d M Y H:i:s'],
            ],
            [
                'label'=> 'Created At',
                'attribute'=>'updated_at',
                 'format' => ['date', 'php:d M Y H:i:s'],
            ],
        ],
    ]) ?>
  
        <?php 
        if(isset($do)){
            echo Html::a('Cek Detail', ['/site/profilev','id'=>$model->id], ['class'=>'btn btn-primary','target'=>'_blank']);
        }
        ?>

</div>


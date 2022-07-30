<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\User;
use app\models\Costumer;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
$url = \yii\helpers\Url::to(['costumer/karyawan']);

/* @var $this yii\web\View */
/* @var $model app\models\Barangin */
/* @var $form yii\widgets\ActiveForm */
 $usr=ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');
 $cos=ArrayHelper::map(Costumer::find()->asArray()->all(), 'id', 'nama');

 $cityDesc =empty($model->id_perusahaan) ? '' : Costumer::findOne(['id'=>$model->id_perusahaan])->nama;
 $cityDesc2 =empty($model->id_user) ? '' : User::findOne(['id'=>$model->id_user])->username;

?>

<div class="barangin-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6" style="padding-left: 0px;"> 
        <label class="control-label" for="semen-tgl">Tanggal PO </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['class'=>'form-control','autocomplete'=>'off','readonly'=>'readonly']
    ]);?>
    </div>

    <?= $form->field($model, 'dari')->textInput(['maxlength' => true]) ?>
     <?php 
    echo $form->field($model, 'id_perusahaan')->widget(Select2::classname(), [
        'data'=>$cos,
        'initValueText' => $cityDesc, 
        'options' => ['placeholder' => 'Search for Costumer ...'],
    ]);
    ?> 
    <?php 
    echo $form->field($model, 'id_user')->widget(Select2::classname(), [
        'data'=>$usr,
        'initValueText' => $cityDesc2, 
        'options' => ['placeholder' => 'Search for User ...']
    ]);
    ?> 

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\User;
use app\models\Costumer;
use app\models\Project;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
$url = \yii\helpers\Url::to(['costumer/karyawan']);

/* @var $this yii\web\View */
/* @var $model app\models\Barangin */
/* @var $form yii\widgets\ActiveForm */
 $usr=ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');
 $data=ArrayHelper::map(Project::find()->asArray()->all(), 'id', 'nama');
 $cos=ArrayHelper::map(Costumer::find()->asArray()->all(), 'id', 'nama');

 $cityDesc =empty($model->id_perusahaan) ? '' : Costumer::findOne(['id'=>$model->id_perusahaan])->nama;
 $cityDesc2 =empty($model->id_user) ? '' : User::findOne(['id'=>$model->id_user])->username;
$script = <<< JS
$(document).on("select2:open", () => {
  document.querySelector(".select2-container--open .select2-search__field").focus()
})
JS;
$position= View::POS_END;
$this->registerJs($script,$position);
?>

<div class="barangpo-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6" style="padding-left: 0px;"> 
        <label class="control-label" for="semen-tgl"> <?=\Yii::t('yii', 'Date')?> <?=\Yii::t('yii', 'Purchase Orders')?> </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['class'=>'form-control','autocomplete'=>'off','readonly'=>'readonly']
    ]);?>
    </div>

    <?= $form->field($model, 'dari')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'curr')->textInput(['maxlength' => true]) ?>

    <?php 
    //echo $form->field($model, 'id_perusahaan')->dropDownList($cos, ['id'=>'cat-id']);
    echo $form->field($model, 'id_user')->widget(Select2::classname(), [
        'id'=>'cat-id',
        'data'=>$usr,
        'initValueText' => $cityDesc2, 
        'options' => ['placeholder' => 'Search for User ...'],
    ]);
    echo $form->field($model, 'id_project')->widget(DepDrop::classname(), [
    'data'=>$data,
    'options'=>['id'=>'cat-id'],
    'type' => DepDrop::TYPE_SELECT2,
    'pluginOptions'=>[
        'depends'=>['barangpo-id_user'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/site/subcatuser'])
    ]
    ]);
     
    /* Child # 2
    echo $form->field($model, 'prod')->widget(DepDrop::classname(), [
        'pluginOptions'=>[
            'depends'=>['cat-id', 'subcat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/site/prod'])
        ]
    ]);
    echo $form->field($model, 'id_perusahaan')->widget(Select2::classname(), [
        'data'=>$cos,
        'initValueText' => $cityDesc, 
        'options' => ['placeholder' => 'Search for Costumer ...'],
    ]);*/
    ?> 
   
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

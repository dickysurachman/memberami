<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\web\View;
use app\models\Barang;
use yii\web\JsExpression;
$url = \yii\helpers\Url::to(['barang/cari']);
/* @var $this yii\web\View */
/* @var $model app\models\Barangpodetail */
/* @var $form yii\widgets\ActiveForm */

$cityDesc =empty($model->id_barang) ? '' : Barang::findOne(['id'=>$model->id_barang])->nama;
?>

<div class="barangpodetail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    echo $form->field($model, 'id_barang')->widget(Select2::classname(), [
        'initValueText' => $cityDesc, 
        'options' => ['placeholder' => 'Search for '.\Yii::t('yii', 'Commodity').' ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(id_barang) { return id_barang.text; }'),
            'templateSelection' => new JsExpression('function (id_barang) { return id_barang.text; }'),
        ],
    ]);
    ?> 

    <?= $form->field($model, 'qty')->textInput() ?>

 
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

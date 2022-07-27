<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\models\City;
use app\models\Segment;
$url = \yii\helpers\Url::to(['site/kota']);
use yii\helpers\ArrayHelper;

$cityDesc =empty($model->id_city) ? '' : City::findOne(['id'=>$model->id_city])->name;
$dataPost=ArrayHelper::map(Segment::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name')
/* @var $this yii\web\View */
/* @var $model app\models\Costumer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="costumer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
	<?php 
    echo $form->field($model, 'id_city')->widget(Select2::classname(), [
        'initValueText' => $cityDesc, 
        'options' => ['placeholder' => 'Search for City ...'],
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
            'templateResult' => new JsExpression('function(id_city) { return id_city.text; }'),
            'templateSelection' => new JsExpression('function (id_city) { return id_city.text; }'),
        ],
    ]);
    ?> 
    <?= $form->field($model, 'id_segmen')->dropDownlist($dataPost,['prompt'=>'Choose']) ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

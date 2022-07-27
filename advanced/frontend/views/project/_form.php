<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\models\Costumer;
use kartik\money\MaskMoney;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['costumer/karyawan']);

$cityDesc =empty($model->id_costumer) ? '' : Costumer::findOne(['id'=>$model->id_costumer])->nama;
$dataPost=['0'=>"Open",'1'=>'Win','2'=>'Lose'];
$script = <<< JS
$(document).on("select2:open", () => {
  document.querySelector(".select2-container--open .select2-search__field").focus()
})
JS;
$position= View::POS_END;
$this->registerJs($script,$position);
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <div class="col-md-12" style="padding: 0px !important">
       <label class="control-label" for="semen-tgl"><?php echo "Tanggal Mulai Project" ?> </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['class'=>'form-control','autocomplete'=>'off','readonly'=>'readonly']
    ]);?></div>
     <?php 
    echo $form->field($model, 'id_costumer')->widget(Select2::classname(), [
        'initValueText' => $cityDesc, 
        'options' => ['placeholder' => 'Search for Costumer ...'],
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
            'templateResult' => new JsExpression('function(id_costumer) { return id_costumer.text; }'),
            'templateSelection' => new JsExpression('function (id_costumer) { return id_costumer.text; }'),
        ],
    ]);
    ?> 


    <div class="col-md-12" style="padding: 0px !important">
       <label class="control-label" for="semen-tgl"><?php echo "Tanggal Deadline" ?> </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal_deadline',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['class'=>'form-control','autocomplete'=>'off','readonly'=>'readonly']
    ]);?></div>
     <?php   
        echo $form->field($model, 'jumlah')->widget(MaskMoney::classname());
     ?>    
    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'status')->dropDownlist($dataPost) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

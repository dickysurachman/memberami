<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Training */
/* @var $form yii\widgets\ActiveForm */
$dataPost=['REQUEST','APPROVED','REJECT','RESCHEDULE'];

?>

<div class="training-form">

    <?php $form = ActiveForm::begin(); ?>

   


    <div class="col-md-12" style="padding: 0px !important">
       <label class="control-label" for="semen-tgl"><?php echo "Tanggal Request" ?> </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal_r',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['class'=>'form-control','autocomplete'=>'off','readonly'=>'readonly']
    ]);?></div>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'status')->dropDownlist($dataPost) ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

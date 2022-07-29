<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Training */
/* @var $form yii\widgets\ActiveForm */
use hscstudio\mimin\components\Mimin;
if(Mimin::checkRoute('userk/create')){
$dataPost=['REQUEST','APPROVED','REJECT','RESCHEDULE'];
} else {
$dataPost=['REQUEST'];
}

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

   
     <?= $form->field($model, 'status')->dropDownlist($dataPost,['onChange'=>'if($(this).val()>=2)
     {
      var divs = document.getElementById("onof");
      divs.style.display="";         
      } 
      else{
      var divs = document.getElementById("onof");
      divs.style.display="none";
      }
      ']) ?>
   <div id="onof" style="display:none;">
    <?= $form->field($model, 'ket')->textarea(['rows' => 3]) ?>
   </div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
  <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'person_c')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

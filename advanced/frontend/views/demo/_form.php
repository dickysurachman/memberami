<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\models\Costumer;
use kartik\money\MaskMoney;
use yii\jui\DatePicker;
use hscstudio\mimin\components\Mimin;
if(Mimin::checkRoute('userk/create')){
$dataPost=['REQUEST','APPROVED','REJECT','RESCHEDULE'];
} else {
$dataPost=['REQUEST'];
}
/* @var $this yii\web\View */
/* @var $model app\models\Demo */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['costumer/karyawan']);
$cityDesc =empty($model->id_costumer) ? '' : Costumer::findOne(['id'=>$model->id_costumer])->nama;

$script = <<< JS
$(document).on("select2:open", () => {
  document.querySelector(".select2-container--open .select2-search__field").focus()
})
JS;
$position= View::POS_END;
$this->registerJs($script,$position);

?>

<div class="demo-form">

    <?php $form = ActiveForm::begin(); ?>

  
   

    <div class="col-md-12" style="padding: 0px !important">
       <label class="control-label" for="semen-tgl"><?php echo "Tanggal Demo" ?> </label>
        <?php
        echo DatePicker::widget([
        'model'  => $model,
        'attribute'=>'tanggal',
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
   
    <?php   
        echo $form->field($model, 'jumlah')->widget(MaskMoney::classname());
     ?>  
    <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'person_c')->textInput(['maxlength' => true]) ?>

  
    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

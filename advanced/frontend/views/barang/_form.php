<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
$st=['Indent','Ready'];
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'status')->dropDownList($st,array('prompt'=>'Silahkan Pilih'))  ?>
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
  <?php    echo $form->field($model, 'harga')->widget(MaskMoney::classname()); ?>

   <?= $form->field($model, 'ukuran')->textarea(['rows' => 3]) ?>

  
    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

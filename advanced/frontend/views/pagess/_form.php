<?php
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
$dataPost=['Tidak Aktif','Aktif'];
//use kartik\icons\FontAwesomeAsset;
//FontAwesomeAsset::register($this);
?>
<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownlist($dataPost) ?>

<?php 
    echo $form->field($model, 'konten')->widget(Summernote::class, [
    //'useKrajeePresets' => true,
    'options' => ['placeholder' => 'Edit your blog content here...'],
    //'pluginLoading' => false,
    'container' => [
                'class' => 'kv-editor-container',
            ],
]);

?>
   


  
    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

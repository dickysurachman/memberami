<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\models\City;
use kartik\file\FileInput;
use app\models\User;
$url = \yii\helpers\Url::to(['site/kota']);
$this->title=\Yii::t('yii', 'Update')." ".\Yii::t('yii', 'Profile');

$cityDesc =empty($model->id_kota) ? '' : City::findOne(['id'=>$model->id_kota])->name;
/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
/* @var $form yii\widgets\ActiveForm */

$cek =User::findOne($model->id_user);
if($cek) 
{
    $mem2=isset($cek->level)?$cek->level->nama:'';
    $mem="Member Level :".$mem2;

} else {
    $mem="Member Level :";

}
$script = <<< JS
$(document).on("select2:open", () => {
  document.querySelector(".select2-container--open .select2-search__field").focus()
})
JS;
$position= View::POS_END;
$this->registerJs($script,$position);
?>
 <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>    

<div class="perusahaan-form">




    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
    <label for="perusahaan-nama_d"><?php echo $mem ?></label>
    
    </div>
    <?= $form->field($model, 'telp_c')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nama_d')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>



   <?php 
    echo $form->field($model, 'id_kota')->widget(Select2::classname(), [
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
            'templateResult' => new JsExpression('function(id_kota) { return id_kota.text; }'),
            'templateSelection' => new JsExpression('function (id_kota) { return id_kota.text; }'),
        ],
    ]);
    ?> 
    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_s')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'telp_s')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email_s')->textInput(['maxlength' => true]) ?>

    
    <?php
    if(isset($model->logo)){
    $images=Yii::$app->homeUrl."/images/".$model->logo;
    echo $form->field($model, 'logo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
     'pluginOptions' => [
        'initialPreview'=>[
            $images
        ],
        'initialPreviewAsData'=>true,
         'maxFile'=>1,
    ]
    ]);
    } else {
        
    echo $form->field($model, 'logo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
     'pluginOptions' => [
        'maxFile'=>1,
    ]
    ]); 
    }
     ?>

    
  
    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? \Yii::t('yii', 'Create') : \Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

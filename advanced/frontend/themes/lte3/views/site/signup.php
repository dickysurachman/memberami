<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
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

$script = <<< JS
$(document).on("select2:open", () => {
  document.querySelector(".select2-container--open .select2-search__field").focus()
})
JS;
$position= View::POS_END;
$this->registerJs($script,$position);
?>
 <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>    
<style type="text/css">
    .login-box {
        width: 80% !important;
    }
    .login-page, .register-page {
        height: 100% !important;
    }

</style>
<?= Alert::widget() ?>
<div class="card">
    <div class="card-body login-card-body">

         <p class="login-box-msg">Please fill out the following fields to signup:</p>
        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form','options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
       <?= $form->field($model,'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
    <div class="row">
        <div class="col-md-2">
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?> </div> 
        <div class="col-md-3">
    <?= $form->field($model, 'telp_c')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-2">
    <?= $form->field($model, 'nama_d')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3">
    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-2">
    <?= $form->field($model, 'email_c')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">    
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
    ?> </div>
        <div class="col-md-4">    
    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-5">    
    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'nama_s')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-4">
    <?= $form->field($model, 'telp_s')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-4">
    <?= $form->field($model, 'email_s')->textInput(['maxlength' => true]) ?></div>
    </div>

    
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

    <div class="row">
    <div class="col-md-3">
    <?php
    if(isset($model->akta)){
    $akta=Yii::$app->homeUrl."/images/dll/".$model->akta;
    echo $form->field($model, 'akta')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'initialPreview'=>[
            $akta
        ],
        'initialPreviewConfig'=> [
            ['type'=>"pdf",  'size'=>8000, 'url'=> $akta], 
        ],
 
        'initialPreviewAsData'=>true,
         'maxFile'=>1,
    ]
    ]);
    } else {
        
    echo $form->field($model, 'akta')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'maxFile'=>1,
    ]
    ]); 
    }
     ?>
    </div>
    <div class="col-md-3">
    <?php
    if(isset($model->npwp_f)){
    $npwp_f=Yii::$app->homeUrl."/images/dll/".$model->npwp_f;
    echo $form->field($model, 'npwp_f')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'initialPreview'=>[
            $npwp_f
        ],
        'initialPreviewConfig'=> [
            ['type'=>"pdf",  'size'=>8000, 'url'=> $npwp_f], 
        ],
        'initialPreviewAsData'=>true,
         'maxFile'=>1,
    ]
    ]);
    } else {
        
    echo $form->field($model, 'npwp_f')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'maxFile'=>1,
    ]
    ]); 
    }
     ?>
     </div>
    <div class="col-md-3">
    <?php
    if(isset($model->kemenkumham)){
    $kemenkumham=Yii::$app->homeUrl."/images/dll/".$model->kemenkumham;
    echo $form->field($model, 'kemenkumham')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'initialPreview'=>[
            $kemenkumham
        ],
        'initialPreviewConfig'=> [
            ['type'=>"pdf",  'size'=>8000, 'url'=> $kemenkumham], 
        ],
        'initialPreviewAsData'=>true,
         'maxFile'=>1,
    ]
    ]);
    } else {
        
    echo $form->field($model, 'kemenkumham')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'maxFile'=>1,
    ]
    ]); 
    }
     ?>
    </div>
    <div class="col-md-3">
    <?php
    if(isset($model->nib)){
    $nib=Yii::$app->homeUrl."/images/dll/".$model->nib;
    echo $form->field($model, 'nib')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'initialPreview'=>[
            $nib
        ],
       'initialPreviewConfig'=> [
            ['type'=>"pdf",  'size'=>8000, 'url'=> $nib], 
        ],        
        'initialPreviewAsData'=>true,
         'maxFile'=>1,
    ]
    ]);
    } else {
        
    echo $form->field($model, 'nib')->widget(FileInput::classname(), [
    'options' => ['accept' => 'pdf/*'],
     'pluginOptions' => [
        'maxFile'=>1,
    ]
    ]); 
    }
     ?>

    </div>
    </div>
        <div class="row">
            <div class="col-8">
                <?= Html::a('Home Page', 'https://www.gso.co.id') ?><br/>
                 <?= Html::a('Forget Password', Url::to('request-password-reset.html')) ?>
                
            </div>
            <div class="col-4">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a('Sign In', Url::to('login.html'),['class' => 'btn btn-danger btn-block']) ?>

            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

       
        <!-- /.social-auth-links -->

        
    </div>
    <!-- /.login-card-body -->
</div>
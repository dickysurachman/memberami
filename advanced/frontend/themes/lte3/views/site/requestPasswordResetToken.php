<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
?>
<?= Alert::widget() ?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Please fill out your email. A link to reset password will be sent there</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>
        <?= $form->field($model, 'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']])->textInput(['autofocus' => true]) ?>


        <div class="row">
            <div class="col-8">
                  <?= Html::a('Home Page', 'https://www.gso.co.id') ?> <br/>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a('Sign Up', Url::to('signup.html'),['class' => 'btn btn-danger btn-block']) ?>

            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

       
        <!-- /.social-auth-links -->

        
    </div>
    <!-- /.login-card-body -->
</div>

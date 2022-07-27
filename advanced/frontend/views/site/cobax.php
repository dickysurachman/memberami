<?php 
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs(
'$("#formSubmit").on("submit",function(e){
        var formData = new FormData(this);
        var formURL = $("#formSubmit").attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : formData,
            contentType: false,
            processData: false,
            success:function(data, textStatus, jqXHR) 
            {
                window.location = "{$urlIndex}";
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                alert("gagal");      
            }
        });
        e.preventDefault();
        e.unbind(); untuk mencegah berkali kali submit
    });'
);
?>




<h3>test Pjax</h3>

<?php Pjax::begin(['id'=>'id-pjax','timeout' => false,'linkSelector' => false,'enablePushState' => false]); ?>

<?= Html::beginForm(['site/test1'], 'post', ['data-pjax' => '', 'class' => 'form-inline','id'=>'options-form']); ?>
    <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Hash String', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
<?= Html::endForm() ?>

<?php Pjax::end(); ?>
<span id="modal-response"></span>

<?php
Pjax::widget([
    'id' => 'modal-response',  // response goes in this element
    'enablePushState' => false, 
    'enableReplaceState' => false, 
    'formSelector' => '#options-form',// this form is submitted on change
    'submitEvent' => 'change',
    ]);
?>



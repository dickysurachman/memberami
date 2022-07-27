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
            success: function(res){
               $("#room_type").append(res);
               $("#project-nama").val("");

            },
            error: function(res){
                $("#room_type").text("Error!");
                
            }
        });
        e.preventDefault();
       
    });'
);
?>


<?php $form = ActiveForm::begin(['options' => ['id'=>'formSubmit']]); ?>
 
    <?= $form->field($model, 'nama')->textInput() ?>
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
 <div id="room_type"></div>
    <?php ActiveForm::end(); ?>
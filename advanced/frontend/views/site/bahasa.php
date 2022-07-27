<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
//use yii\helpers\Url;

  if(isset(Yii::$app->session['lang']))
    {
            $en=Yii::$app->session['lang'];
            if($en=='en'){
                $name= 'Language';
            }else{
                $name= 'Setting Bahasa';
            }

    } 
    else
    {            
        $name= 'Language';
    }
//$name="Language";
//$message="huhuhu";
$this->title = $name;
?>
<div class="bahasa-update">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'bahasa')->radioList(array('en'=>'English','id'=>'Bahasa')); ?>
     <div class="form-group">
        <?= Html::submitButton(\Yii::t('yii', 'Save'), ['class' =>  'btn btn-primary']) ?>
    </div>

   <?php ActiveForm::end(); 
    
   

   ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BarangpoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barangpo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'dari') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'id_perusahaan') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'add_who') ?>

    <?php // echo $form->field($model, 'add_date') ?>

    <?php // echo $form->field($model, 'edit_who') ?>

    <?php // echo $form->field($model, 'edit_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barangpo */


$this->title = Yii::t('yii', 'Update').' '.\Yii::t('yii', 'Purchase Orders');

$this->params['breadcrumbs'][] = ['label' => \Yii::t('yii', 'Purchase Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="barangpo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

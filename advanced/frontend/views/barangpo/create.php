<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barangpo */

$this->title = Yii::t('yii', 'Create').' '.\Yii::t('yii', 'Purchase Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Barangpos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barangpo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

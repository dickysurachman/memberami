<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Demo */
?>
<div class="demo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'nama',
            'tanggal',
            //'id_costumer',
            'statusnya',
            'jumlah',
            'ket'
        ],
    ]) ?>

</div>

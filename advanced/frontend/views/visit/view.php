<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visit */
?>
<div class="visit-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'tanggal',
            'id_costumer',
            'status',
            'nama_ap',
            'jumlah',
        ],
    ]) ?>

</div>

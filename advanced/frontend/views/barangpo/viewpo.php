<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barangpodetail */
?>
<div class="barangpodetail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'barang.nama',
            'qty',
            //'id_kode',
            //'status',
        ],
    ]) ?>

</div>

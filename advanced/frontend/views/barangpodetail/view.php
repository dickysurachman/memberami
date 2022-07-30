<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barangpodetail */
?>
<div class="barangpodetail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_barang',
            'qty',
            'id_kode',
            'status',
        ],
    ]) ?>

</div>

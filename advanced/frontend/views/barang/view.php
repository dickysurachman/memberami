<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
?>
<div class="barang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kode',
            'nama',
            'ukuran',
           
        ],
    ]) ?>

</div>

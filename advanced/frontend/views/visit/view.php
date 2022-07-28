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
            //'nama',
            'tanggal',
            //'id_costumer',
            'statusnya',
            'person',
            'person_c',
            'ket',
            //'jumlah',
        ],
    ]) ?>

</div>

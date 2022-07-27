<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Training */
?>
<div class="training-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal_r',
            'status',
            'keterangan:ntext',
            'nama',
        ],
    ]) ?>

</div>

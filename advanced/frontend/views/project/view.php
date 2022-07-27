<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
?>
<div class="project-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'id_costumer',
            'tanggal',
            'deskripsi:ntext',
            'jumlah',
            'status',
            'tanggal_deadline',
        ],
    ]) ?>

</div>

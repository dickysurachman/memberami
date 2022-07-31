<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
?>
<div class="project-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nama',
            [ 'attribute'=> 'id_costumer',
                'value'=>isset($model->costumer)?$model->costumer->nama:'',
            ],
            'tanggal',
            'deskripsi:ntext',
            'jumlah',
            'statusnya',
            'tanggal_deadline',
        ],
    ]) ?>

</div>

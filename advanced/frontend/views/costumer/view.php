<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Costumer */
?>
<div class="costumer-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'telp',
            'alamat',
            [
                'attribute'=>'id_city',
                'value'=>isset($model->kota)?$model->kota->name:'',
            ],
            [
                'attribute'=>'id_segmen',
                'value'=>isset($model->segmen)?$model->segmen->name:'',
            ]
            //'person',
            //'person_c',
        ],
    ]) ?>

</div>

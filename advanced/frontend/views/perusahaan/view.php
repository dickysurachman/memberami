<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
?>
<div class="perusahaan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_user',
            'nama',
            'alamat',
            'nama_d',
            'npwp',
            'id_kota',
            'telp',
            'logo',
            'status',
        ],
    ]) ?>

</div>

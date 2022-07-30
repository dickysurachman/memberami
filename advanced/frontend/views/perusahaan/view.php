<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
 $images=Yii::$app->homeUrl."/images/".$model->logo;
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
            [
                'attribute'=>'id_kota',
                'value'=>isset($model->city)?$model->city->name:'',
            ],
            'telp',
            [
            'attribute'=>'logo',
            'value'=>(Yii::$app->homeUrl."/images/" . $model->logo),
            'format' => ['image',['width'=>'230','height'=>'200']],
            ]
            //'logo',
            //'status',
        ],
    ]) ?>

</div>

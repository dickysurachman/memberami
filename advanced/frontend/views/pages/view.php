<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
?>
<div class="pages-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'judul',
            //'konten:ntext',
            //'status',
            'slug',
            'created',
        ],
    ]) ?>

</div>

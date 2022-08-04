<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Level */
?>
<div class="level-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'diskon',
            'status',
        ],
    ]) ?>

</div>

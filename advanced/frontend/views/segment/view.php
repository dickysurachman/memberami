<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Segment */
?>
<div class="segment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>

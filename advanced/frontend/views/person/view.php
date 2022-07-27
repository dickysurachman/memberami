<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
?>
<div class="person-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'telp',
            'email:email',
            'id_costumer',
            'id_user',
        ],
    ]) ?>

</div>

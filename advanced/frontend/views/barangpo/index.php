<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangpoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('yii', 'Purchase Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barangpo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php 

        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'tanggal',
            'kode',
            'dari',
            [
                'attribute'=>'id_perusahaan',
                'value'=>'namapr',
            ],
            [
                'attribute'=>'id_user',
                'value'=>'user.username',
            ],

            'keterangan:ntext',
        ];

        // Renders a export dropdown menu
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'batchSize'=>0,

        ]);


    ?>
    
        <?= Html::a(Yii::t('yii', 'Create').' '.\Yii::t('yii', 'Purchase Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tanggal',
            'kode',
            'dari',
            [
                'attribute'=>'id_perusahaan',
                'value'=>'namapr',
            ],
            [
                'attribute'=>'id_user',
                'value'=>'user.username',
            ],

            'keterangan:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

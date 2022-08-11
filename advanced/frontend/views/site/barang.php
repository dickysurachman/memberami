<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Commodity');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<?php 

$col=
[
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode',
        'header'=>'Barcode',
         'format' => 'raw',
            'value'=>function ($data) {
                return '<img alt="testing" src="'.str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=25&text='.$data->kode.'">';
                                },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ukuran',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'harga',
        'hAlign' => 'right',
        'format'=>['decimal',2],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'harga',
        'header'=> Yii::t('yii', 'Patner Price'),
        'value'=>'hargamember',
        'hAlign' => 'right',
        //'format'=>['decimal',2],
    ],
];

?>
<div class="barang-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => $col,
            'toolbar'=> [
                ['content'=>
                    
                    Html::a('<i class="fa fa-redo"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'responsiveWrap' => false,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
                'before'=>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
                'after'=>'<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => [
        "tabindex" => false,
        "backdrop" => "static",
        "keyboard" => false,
    ],
    "options" => [
        "tabindex" => false
    ]
])?>
<?php Modal::end(); ?>

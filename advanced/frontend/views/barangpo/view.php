<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Barangpo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('yii', 'Purchase Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$this->title = \Yii::t('yii', 'Purchase Orders') .' '.\Yii::t('yii', 'Commodity');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="barangpo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Print'), ['print', 'id' => $model->id], ['class' => 'btn btn-success','target'=>"_blank"]) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'tanggal',
            'kode',
            'dari',
            'keterangan:ntext',
            //'id_perusahaan',
            //'id_user',
            //'status',
            //'add_who',
            //'add_date',
            //'edit_who',
            //'edit_date',
        ],
    ]) ?>


<div class="barangpodetail-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a(Yii::t('yii2-ajaxcrud', 'Create New'), ['createpo','id'=>$model->id],
                    ['role'=>'modal-remote','title'=> Yii::t('yii2-ajaxcrud', 'Create New').' Barangpodetails','class'=>'btn btn-outline-primary']).
                    Html::a('<i class="fa fa-redo"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'responsiveWrap' =>false,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
                'before'=>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
                'after'=>                        
                        '<div class="clearfix"></div>',
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

</div>

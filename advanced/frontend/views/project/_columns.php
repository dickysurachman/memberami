<?php
use yii\helpers\Url;
use app\models\Costumer;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use hscstudio\mimin\components\Mimin;
$dataPost=['0'=>"Open",'1'=>'Win','2'=>'Lose'];
$usr=ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');

if(Mimin::checkRoute('project/adddemo')){
    $cos=ArrayHelper::map(Costumer::find()->asArray()->all(), 'id', 'nama');
} else {
    $cos=ArrayHelper::map(Costumer::find()->where(['id_user'=>Yii::$app->user->identity->id])->asArray()->all(), 'id', 'nama');
}

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
     [
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
     'header' => '<span class="fa fa-eye"></span>',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($model, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('viewtrack', ['model' => $model]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_costumer',
        'filter' => $cos,
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
                                'options' => ['prompt' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width'=>'200px'
                                ],
                                ],
        'value'=>function ($model, $key, $index, $widget) { 
                return isset($model->costumer)?$model->costumer->nama:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'deskripsi',
    ],
         
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jumlah',
        'format'=>['decimal',0],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value'=>function ($model, $key, $index, $widget) { 
                return $model->statusnya;
        },
        'filter'=>$dataPost,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kuartal',
        'header'=>'Quarter',
        'value'=>function ($model, $key, $index, $widget) { 
                return $model->quartal;
        },
        //'filter'=>false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_user',
        'filter' => $usr,
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
                                'options' => ['prompt' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width'=>'100px'
                                ],
                                ],
        'visible'=>Mimin::checkRoute('project/adddemo'),
        'value'=>function ($model, $key, $index, $widget) { 
                return isset($model->namauser)?$model->namauser->username:'';
                },
    ],
     [
                'header'=>'Add PO',
                'attribute' => 'img',
                'format' => 'raw',
                'label' => 'Add PO',
                'visible'=>Mimin::checkRoute('barangpo/create'),
                'value'=>function ($data) {
                                return 
                                Html::a('<span class="fas fa-users" style="font-size:14pt;" title="Print"></span>',['barangpo/project', 'id' => $data->id],
                                    ['target'=>'_blank', 'data-pjax'=>"0",'class' => 'linksWithTarget']);
                                },
    ],    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => true,
        'dropdownOptions'=>['header-dropdown'=>'Tambah'],
        'header'=>'Tambah Data',
        'vAlign'=>'middle',
        'visible'=>Mimin::checkRoute('project/adddemo'),
        'template'=>'{demo}{training}{visit}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'demo' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-users"></span>&nbsp;Tambah Demo<br/>', ['adddemo', 'id'=>$model->id],['data-pjax' => "1",'role'=>'modal-remote','title'=>'Add Personal Contact','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']);
            },
            'training' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-users"></span>&nbsp;Tambah Training<br/>', ['addtraining', 'id'=>$model->id],['data-pjax' => "1",'role'=>'modal-remote','title'=>'Add Personal Contact','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']);
            },
            'visit' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-users"></span>&nbsp;Tambah Visit', ['addvisit', 'id'=>$model->id],['data-pjax' => "1",'role'=>'modal-remote','title'=>'Add Personal Contact','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']);
            },

        ],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger', 
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm') ],
    ],

];   
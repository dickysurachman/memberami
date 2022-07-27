<?php
use yii\helpers\Url;
use yii\helpers\Html;
$fl=['Tidak Aktif','Aktif'];
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'judul',
    ],
//    [
 //       'class'=>'\kartik\grid\DataColumn',
 //       'attribute'=>'konten',
  //  ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'filter'=>$fl,
        'value'=>function ($model, $key, $index, $widget) { 
                return ($model->status==0)?'Tidak Aktif':'Aktif';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slug',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created',
    ],
    [
                //'class' => 'yii\grid\ActionColumn',
                'header'=>'Preview',
                'attribute' => 'Status',
                'format' => 'raw',
                'label' => 'Preview',
                'value'=>function ($data) {
                                return Html::a('<span class="fas fa-eye" style="font-size:14pt;" title="Preview"></span>',['site/indeks', 'id' => $data->slug],
                                    ['target'=>'_blank', 'class' => 'linksWithTarget','data-pjax' => '0'])  ;
                                },
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
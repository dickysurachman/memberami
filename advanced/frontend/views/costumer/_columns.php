<?php
use yii\helpers\Url;
use app\models\Segment;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use hscstudio\mimin\components\Mimin;
$usr=ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');




return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'telp',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'alamat',
    ],
     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kotas',
        'header'=>\Yii::t('yii', 'City'),
        'value'=>function ($model, $key, $index, $widget) { 
                return isset($model->kota)?$model->kota->name:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_segmen',
        'filter' => ArrayHelper::map(Segment::find()->asArray()->all(), 'id', 'name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
                                'options' => ['prompt' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width'=>'200px'
                                ],
                                ],
        'value'=>function ($model, $key, $index, $widget) { 
                return isset($model->segmen)?$model->segmen->name:'';
        },
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
        'visible'=>Mimin::checkRoute('userk/create'),
        'value'=>function ($model, $key, $index, $widget) { 
                return isset($model->namauser)?$model->namauser->username:'';
                },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header'=>\Yii::t('yii', 'Action'),
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}{user}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'user' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-users"></span>', ['addperson', 'id'=>$model->id],['data-pjax' => "1",'role'=>'modal-remote','title'=>'Add Personal Contact','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success']);
            },
        ],
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
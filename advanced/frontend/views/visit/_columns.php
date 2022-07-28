<?php
use yii\helpers\Url;
$dataPost=['REQUEST','APPROVED','REJECT','RESCHEDULE'];
use app\models\Costumer;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use hscstudio\mimin\components\Mimin;
if(Mimin::checkRoute('project/adddemo')){
    $cos=ArrayHelper::map(Costumer::find()->asArray()->all(), 'id', 'nama');
} else {
    $cos=ArrayHelper::map(Costumer::find()->where(['id_user'=>Yii::$app->user->identity->id])->asArray()->all(), 'id', 'nama');
}
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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
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
        'attribute'=>'status',
         'value'=>function ($model, $key, $index, $widget) { 
                return $model->statusnya;
        },
        'filter'=>$dataPost,
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
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'jumlah',
    // ],
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
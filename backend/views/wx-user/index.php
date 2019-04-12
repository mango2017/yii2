<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WxUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '虚拟好友管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nickName',
            'remarkName',
            'sign',
            ['attribute'=>'sex','value'=>function($model){
                if($model->sex == 1)
                    return '男';
                elseif($model->sex == 2)
                    return '女';
                else
                    return '未知';

            }],
            'city',

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>







</div>

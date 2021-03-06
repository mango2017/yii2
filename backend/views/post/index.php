<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,  //生成查询表单
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'id','contentOptions'=>['style' => 'width: 30px']],
            'title',
//            'content:ntext',
//            'tags:ntext',
            ['attribute'=>'authorName','label'=>'作者','value'=>'author.nickname'],
            ['attribute'=>'status','value'=>'status0.name','filter'=>\common\models\Poststatus::find()->select(['name','id'])->orderBy('position')->indexBy('id')->column(),],
            //'create_time:datetime',
            //'update_time:datetime',
            //'author_id',
            ['attribute'=>'update_time','format'=>['date','php:Y-m-d H:i:s']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

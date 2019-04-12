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
            //'city',

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    /*

    {'MemberList': <ContactList: []>, 'Uin': 0, 'UserName': '@5f7175254a055abe95540ebcfd11c057', 'NickName': '哈哈镜1', 'HeadImgUrl': '/cgi-bin/mmwebwx-bin/webwxgeticon?seq=683961780&username=@5f7175254a055abe95540ebcfd11c057&skey=@crypt_b8129306_99b0684f22819c497d9b5d02e21ce5ad', 'ContactFlag': 3, 'MemberCount': 0, 'RemarkName': '刘静', 'HideInputBarFlag': 0, 'Sex': 2, 'Signature': '', 'VerifyFlag': 0, 'OwnerUin': 0, 'PYInitial': 'SPANCLASSEMOJIEMOJI1F338SPANHHJ1SPANCLASSEMOJIEMOJI1F3B8SPANSPANCLASSEMOJIEMOJI1F604SPAN', 'PYQuanPin': 'spanclassemojiemoji1f338spanhahajing1spanclassemojiemoji1f3b8spanspanclassemojiemoji1f604span', 'RemarkPYInitial': 'LJ', 'RemarkPYQuanPin': 'liujing', 'StarFriend': 0, 'AppAccountFlag': 0, 'Statues': 0, 'AttrStatus': 103207, 'Province': '辽宁', 'City': '沈阳', 'Alias': '', 'SnsFlag': 49, 'UniFriend': 0, 'DisplayName': '', 'ChatRoomId': 0, 'KeyWord': 'hah', 'EncryChatRoomId': '', 'IsOwner': 0}

    */





</div>

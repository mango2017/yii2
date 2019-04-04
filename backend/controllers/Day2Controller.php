<?php

namespace backend\controllers;

use yii\helpers\Url;
use yii\web\Controller;

class Day2Controller extends Controller
{
    public $layout='home';
    //设置别名
    public function actionAliases()
    {
        //http://localhost/advanced/backend/web/index.php?r=day2/aliases
//        设置别名
        \Yii::setAlias("@baidu","http://www.baidu.com");
        //使用别名
        var_dump(\Yii::getAlias("@baidu"));

        //获取框架定义的别名
        var_dump(\Yii::getAlias("@backend"));
    }

    //url
    public function actionUrl(){
//        echo Url::base("ftp");  //生成协议


        $img = "/images/abc.jpg";
//        $base_url = Url::base(true).$img;
//        echo "<img src={$base_url} width='100px' height='100px'/>" ;

//        echo Url::home();

        echo Url::to(['index/index']);
        echo "<br/>";
        echo Url::to(['index/index','id'=>1,'name'=>'abc']);
        echo "<br/>";
        $url = Url::to(["@web/images/{$img}"]);
        echo "<img src={$url} width='100px' height='100px'/>" ;

    }


    //redis
    public function actionRedisd(){
        $redis = \Yii::$app->redis;
        $key = 'username';
        if($val = $redis->get($key)){
            var_dump($val);
        }else{
            $redis->set($key,'marko');
            $redis->expire($key,5);
        }
    }

    //使用工具函数
    public function actionHelper(){
        $data = [
            'name'=>'jly',
            'age'=>20
        ];
        p($data);
    }

    public function actionHello(){
        var_dump(\Yii::$app->user->isGuest);
        echo \Yii::$app->user->getId();
//        $data = [
//            'user'=>"2323<script>alert('11111');</script>",
//            'age'=>18
//        ];
//        return $this->render('hello',$data);
    }

    //获取params.php文件的内容
    public function actionParam(){
      //  var_dump(\Yii::$app->params['adminEmail']);
        var_dump(\Yii::$app->request->queryParams);
    }



}

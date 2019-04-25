<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/23
 * Time: 16:22
 */
namespace console\controllers;

use Yii;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use yii\console\Controller;


//http://localhost/new_advanced/backend/web/index.php?r=test%2Findex
//rabbitmq receive.php
class TestController extends Controller{
    public function actionIndex(){
       echo 123;
    }
}

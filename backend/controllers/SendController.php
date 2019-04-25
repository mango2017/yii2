<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/23
 * Time: 16:22
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//http://localhost/new_advanced/backend/web/index.php?r=test%2Findex
//rabbitmq send.php
class SendController extends Controller{
    public function actionIndex(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello',false,false,false,false);
        $msg = new AMQPMessage('hello world!!!!');
        $channel->basic_publish($msg,'', 'hello');
        echo " [x] Sent 'Hello World!'\n";
        $channel->close();
        $connection->close();
    }
}

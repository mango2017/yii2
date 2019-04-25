<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/23
 * Time: 16:22
 */
namespace console\controllers;

use Yii;
use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//http://localhost/new_advanced/backend/web/index.php?r=test%2Findex
//rabbitmq send.php
class SendController extends Controller{
    public function actionIndex(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('jly',false,false,false,false);
        $msg = new AMQPMessage('hello world----');
        $channel->basic_publish($msg,'', 'jly');
        echo " [x] Sent 'Hello World!'\n";
        $channel->close();
        $connection->close();
    }
}

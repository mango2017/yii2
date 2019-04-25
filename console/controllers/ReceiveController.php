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


//http://localhost/new_advanced/backend/web/index.php?r=test%2Findex
//rabbitmq receive.php
class ReceiveController extends Controller{
    public function actionIndex(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('jly',false,false,false,false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
        $callback = function($msg){
            echo " [x] Received ", $msg->body, "\n";
        };
        $channel->basic_consume('jly','',false,true,false,false,$callback);
        while(count($channel->callbacks)){
            $channel->wait();
        }
    }
}

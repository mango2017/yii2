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


//http://localhost/new_advanced/backend/web/index.php?r=test%2Findex
//rabbitmq receive.php
class ReceiveController extends Controller{
    public function actionIndex(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello',false,false,false,false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
        $callback = function($msg){
            echo " [x] Received ", $msg->body, "\n";
        };
        $channel->basic_consume('hello','',false,true,false,false,$callback);
        while(count($channel->callbacks)){
            $channel->wait();
        }
    }
}

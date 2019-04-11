<?php

/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-08-30 18:10
 */

namespace backend\modules\v2\controllers;

use yii\web\Response;

class MyController extends \yii\rest\ActiveController {

    public $modelClass;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    const STATUS_ACTIVE = 10; //定义有效数据状态

    public function behaviors() {
        $behaviors = parent::behaviors();
        header('Access-Control-Allow-Origin:*');
        //header('Content-type: image/png');
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON; //默认浏览器打开返回json
        return $behaviors;
    }

    public function actions() {
        return [];
    }

    public function verbs() {
        return [
            'index' => ['GET', 'HEAD','POST'],
            'view' => ['GET','POST'],
            'scroll' => ['POST'],
            'notify' => ['POST','PUT'],//支付回调
            'register' => ['POST'],
            'callback'=>['GET'],
        ];
    }

    public function successMsg($data = []) {
        return $this->baseMsg(1, 'success', $data);
    }

    public function errMsg($errMsg = 'error',$data=[]) {
        return $this->baseMsg(0, $errMsg,$data);
    }

    public function baseMsg($code = 0, $msg = '', $_data = []) {
        $data['code'] = $code;
        $data['msg'] = $msg;
        if (!empty($data))
            $data['data'] = $_data;
        return $data;
    }

    public function actionIndex() {
        return [
            "feehi api service"
        ];
    }

    public function actionLogin() {
        return [
            "username" => 'test',
            "sex" => "male",
        ];
    }

    public function actionRegister() {
        return [
            "success" => true
        ];
    }

}


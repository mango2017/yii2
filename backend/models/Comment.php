<?php

namespace backend\models;

/**
 * v1 module definition class
 */
class comment extends \common\models\Comment
{
    /**
     * {@inheritdoc}
     */
//    public $controllerNamespace = 'backend\modules\v1\controllers';
//
//    /**
//     * {@inheritdoc}
//     */
//    public function init()
//    {
//        parent::init();
//
//        // custom initialization code goes here
//    }
    public function fields()
    {
        return [
            'id',
            'content',
            'status',
            'create_time',
        ];
    }
}

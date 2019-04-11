<?php

namespace backend\modules\v2\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `v2` module
 * http://localhost/new_advanced/backend/web/index.php?r=v2/default/index
 */
header("Content-type:text/html;charset=utf-8");
class DefaultController extends MyController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $modelClass = "backend\models\Comment";

    public function actionIndex()
    {
        $modelClass = $this->modelClass;

        $query = $modelClass::find();

        $products = (new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]));
        $dataProvider['comment']['data'] = $products->getModels();
        $dataProvider['comment']['total'] = $products->getTotalCount();
//        var_dump($dataProvider);
        return $this->successMsg($dataProvider);
    }
}

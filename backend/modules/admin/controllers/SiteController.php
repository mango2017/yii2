<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     * http://localhost/advanced/backend/web/index.php?r=admin/default/index
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

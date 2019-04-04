<?php
namespace backend\controllers;

use common\models\Country;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\EntryForm;
//http://localhost/advanced/backend/web/index.php/site/index
//gii
//http://localhost/advanced/backend/web/index.php?r=gii
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest(){
        echo "test";
    }

    public function actionSay(){
        $model = new EntryForm();
        var_dump(\Yii::$app->request->post());
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据

            // 做些有意义的事 ...

            echo "验证通过";
        } else {
            // 无论是初始化显示还是数据验证错误
            var_dump($model->getErrors());
            return $this->render('say', ['model' => $model]);
        }
    }

    public function actionSays(){
        $countries = Country::find()->orderBy('name')->all();
        var_dump($countries);exit;
        $country = Country::findOne('IN');
        echo $country->name."<br/>";
        $country->name="U.S.A";
        $id = $country->save();
       var_dump($id);

    }







}

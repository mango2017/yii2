<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use backend\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 * http://localhost/advanced/backend/web/index.php?r=article/index
 *
 * 下面给大家介绍一下 yii2.0 场景的使用。小伙多唠叨一下了，就是担心有的人还不知道，
 * 举个简单的例子，现在在 post表里面有 title image content 三个的字段，当我创建一个 post 的时候，
 * 我想三个字段全部是必填项，但是你修改的时候，title content 两个字段是必填的， iamge 可以不填写。
 * 正常的情况下， [['title', 'content', 'image'], 'required',], 但是我们更改的时候 只需要 [['title', 'content'], 'required'], 就可以了，
 * 但是少了 image 字段 我们的表单就无法提交，这种问题怎么办啊？？ 场景可以帮你解决这种问题，下面是一个简单的场景实例。
 *
 * 经过测试：就是在创建表单的时候，title  image  content是必须填写的  但是在更改的时候，只修改title和content的值是有效的，image修改无效
 * 我感觉这种适用于的情况是，只能创建第一次，修改无效的那种情况。
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     * 配置控制器的权限
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $model->setScenario('create');  //调用create场景

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', '保存成功!!!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update'); //调用update场景

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

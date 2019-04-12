<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;
use common\models\Upload;
use PHPExcel;
use yii\web\UploadedFile;

/**
 * Class ImportsController
 * @package backend\controllers
 * 导入微信好友
 */

class ImportsWxController extends Controller{
    public $ok;
    public function actionIndex(){
        //实例化
        $model = new Upload();
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'file');//print_r($file);exit;
            $path="upload/excel/".date("Ymd",time())."/";//print_r($path);exit;
            if ($file && $model->validate()) {
                if (!file_exists($path)) {
                    mkdir($path,0777, true);
                }
                $file->saveAs($path . time() . '.' . $file->getExtension());//print_r($file);exit;
                Yii::$app->session->setFlash('success', '上传成功！');
                $this->data_import($path . time() . '.' . $file->getExtension());
            }
        }
        return $this->render('index',['model'=>$model]);
    }

    public function data_import($file)
    {
        require(Yii::getAlias("@vendor")."/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php");//引入读取excel的类文件
        require(Yii::getAlias("@vendor")."/phpoffice/phpexcel/Classes/PHPExcel.php");
        $filename=$file;//print_r($filename);exit;
        $fileType=\PHPExcel_IOFactory::identify($filename);//自动获取文件的类型提供给phpexcel用
        $objReader=\PHPExcel_IOFactory::createReader($fileType);//获取文件读取操作对象
        $excel = $objReader->load($filename);//引入文件
        $excelSheets = $excel->getAllSheets();
        try {
            foreach ($excelSheets as $SheetIndex => $activeSheet) {
                $sheetColumnTotal = $activeSheet->getHighestRow();//总行数
                if ($sheetColumnTotal == 1) {
                    continue;
                }
                for ($i = 2; $i <= $sheetColumnTotal; $i++) {
                    $data = array(
                        $activeSheet->getCell('A'.$i)->getValue(),
                        $activeSheet->getCell('B' . $i)->getValue(),
                        $activeSheet->getCell('C' . $i)->getValue(),
                        $activeSheet->getCell('D' . $i)->getValue(),
                        $activeSheet->getCell('E' . $i)->getValue(),
                    );//print_r($data);exit;
                    if($data['2'] == '男'){
                        $sex = 1;
                    }else if($data['2'] == '女'){
                        $sex = 2;
                    }else{
                        $sex = 0;
                    }
//                $info=Yii::$app->db->createCommand()->insert(Information::tableName(), [
                    $info = \Yii::$app->db->createCommand()->insert('wx_user', [
                        'nickName' => $data['0'],
                        'remarkName' => $data['1'],
                        'sex' => $sex,
                        'sign'=>$data['3'],
                        'city'=>$data['4']
                    ])->execute();


                    if ($info) {
                        $this->ok = 1;
                    }
                }
            }
        }catch (\yii\db\Exception $e){
            echo $e->getMessage();
        }
        if ($this->ok == 1){
            echo "<script>alert('导入成功');window.history.back();</script>";
//            $this->redirect(['imports/index']);
        } else{
            echo "<script>alert('操作失败');window.history.back();</script>";
        }
    }
}

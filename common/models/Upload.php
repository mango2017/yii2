<?php
namespace common\models;
use Yii;
use yii\base\Model;

class Upload extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => ['xls','xlsx']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => '文件上传'
        ];
    }
}



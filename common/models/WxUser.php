<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wx_user".
 *
 * @property int $id
 * @property string $nickName 微信昵称
 * @property string $remarkName 备注名称
 * @property string $sign 头像
 * @property int $sex 性别
 * @property string $city 城市
 */
class WxUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wx_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex'], 'integer'],
            [['nickName', 'remarkName', 'sign', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickName' => '昵称',
            'remarkName' => '备注',
            'sign' => '签名',
            'sex' => '性别',
            'city' => '城市',
        ];
    }
}

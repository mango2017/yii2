<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questionnaire".
 *
 * @property int $id
 * @property int $player_id 用户id
 * @property string $nickname 游戏昵称
 * @property int $platform 平台 0：小度微游 1：娃娃来了 2：APP 3：H5 4：安卓应用商店
 * @property string $district_service 区服
 * @property string $telphone 手机号
 * @property string $telphone_model 手机型号
 * @property string $system_version 系统版本
 * @property string $question1 0：进入失败 1：进入加载慢 3 无
 * @property string $question2 0：地图加载慢 1：游戏卡顿 2：无
 * @property int $question3 1 是 0 否
 * @property string $detail 改进的内容
 * @property string $content 功能
 * @property int $source 1 娃娃 2 其他 (娃娃发娃娃币 其他给礼包)
 * @property string $create_time 创建时间
 * @property int $status 1:已获奖 0：未获奖
 * @property string $code 礼包码
 */
class Quqestionnaire extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questionnaire';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'nickname', 'platform', 'district_service', 'telphone', 'telphone_model', 'system_version', 'question1', 'question2', 'question3', 'detail', 'content', 'source', 'create_time'], 'required'],
            [['player_id', 'platform', 'question3', 'source', 'status'], 'integer'],
            [['detail', 'content'], 'string'],
            [['create_time'], 'safe'],
            [['nickname', 'code'], 'string', 'max' => 255],
            [['district_service', 'telphone', 'telphone_model', 'system_version', 'question1', 'question2'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_id' => 'Player ID',
            'nickname' => 'Nickname',
            'platform' => 'Platform',
            'district_service' => 'District Service',
            'telphone' => 'Telphone',
            'telphone_model' => 'Telphone Model',
            'system_version' => 'System Version',
            'question1' => 'Question1',
            'question2' => 'Question2',
            'question3' => 'Question3',
            'detail' => 'Detail',
            'content' => 'Content',
            'source' => 'Source',
            'create_time' => 'Create Time',
            'status' => 'Status',
            'code' => 'Code',
        ];
    }
}

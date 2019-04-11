<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questionnaire_code".
 *
 * @property int $id
 * @property string $code code码
 * @property int $status 1：已发出 0：未发出
 * @property int $code_type 1:娃娃 2：其他
 */
class QuestionnaireCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questionnaire_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'code_type'], 'required'],
            [['status', 'code_type'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'status' => 'Status',
            'code_type' => 'Code Type',
        ];
    }
}

<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WxUser;

/**
 * WxUserSearch represents the model behind the search form of `common\models\WxUser`.
 */
class WxUserSearch extends WxUser
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['sex','string'],
            [['nickName', 'remarkName', 'sign', 'city'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WxUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // 1:男 2：女 0 ：未知
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sex' => $this->sex,
        ]);




        $query->andFilterWhere(['like', 'nickName', $this->nickName])
            ->andFilterWhere(['like', 'remarkName', $this->remarkName])
            ->andFilterWhere(['like', 'sign', $this->sign])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}

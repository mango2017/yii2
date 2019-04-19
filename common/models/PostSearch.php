<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 * 搜索功能
 */
class PostSearch extends Post
{
    //添加额外属性
    public function attributes(){
        return array_merge(parent::attributes(),['authorName']);
    }

    /**
     * {@inheritdoc}
     * 这个方法相当于重写了
     */
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'content', 'tags','authorName'], 'safe'],
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
        $query = Post::find();

        // add conditions that should always apply here
        //可以进行分页和排序
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>6],//分页
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC
                ],  //排序
                'attributes'=>['id','title']  //哪些属性可以排序
            ]
        ]);

        $this->load($params); //把表单的值快速赋值给模型属性

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags]);


        $query->join('INNER JOIN','adminuser','post.author_id = adminuser.id');
        $query->andFilterWhere(['like','adminuser.nickname',$this->authorName]);

        //按作者进行排序
        $dataProvider->sort->attributes['authorName'] = [
          'asc'=>['adminuser.nickname'=>SORT_ASC],
          'desc'=>['adminuser.nickname'=>SORT_DESC],
        ];



        return $dataProvider;
    }
}

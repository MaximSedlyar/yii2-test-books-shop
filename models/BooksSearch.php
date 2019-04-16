<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pages', 'price'], 'integer'],
            [['author_id', 'topic_id',], 'string'],
            [['isbn', 'year'], 'safe'],
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
        $query = Books::find();
        $query->leftJoin('authors', 'authors.id = books.author_id');
        $query->leftJoin('topics', 'topics.id = books.topic_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => isset($params['numberPages']) ? $params['numberPages'] : 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pages' => $this->pages,
            'year' => $this->year,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'isbn', $this->isbn])
                ->andFilterWhere(['like', 'authors.name', $this->author_id])
                ->andFilterWhere(['like', 'topics.id', $this->topic_id]);

        return $dataProvider;
    }
}

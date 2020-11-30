<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'year', 'rating'], 'integer'],
            [['name', 'authorName'], 'safe'],
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
        $query->joinWith(['author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'authorName' => [
                    'asc' => [Authors::tableName() . '.name' => SORT_ASC],
                    'desc' => [Authors::tableName() . '.name' => SORT_DESC]
                    ],
                'year',
                'name',
                'rating',
            ],
            'defaultOrder' => ['rating' => SORT_DESC],
        ]);

         if (isset($params['author_id'])) {
             $this->author_id = $params['author_id'];
             $dataProvider->setSort([
                 'defaultOrder' => ['year' => SORT_ASC],
             ]);
         }

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'year' => $this->year,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', Authors::tableName() . '.name', $this->authorName]);

        return $dataProvider;
    }
}

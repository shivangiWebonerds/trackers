<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Issues;

/**
 * IssuesSearch represents the model behind the search form about `common\models\Issues`.
 */
class IssuesSearch extends Issues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vote', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['title', 'description', 'mobile', 'raised_by', 'raised_date', 'completion_date', 'status', 'loclat', 'loclong', 'image', 'dept', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Issues::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'raised_date' => $this->raised_date,
            'completion_date' => $this->completion_date,
            'vote' => $this->vote,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'raised_by', $this->raised_by])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'loclat', $this->loclat])
            ->andFilterWhere(['like', 'loclong', $this->loclong])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'dept', $this->dept]);

        return $dataProvider;
    }
}

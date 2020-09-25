<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Fsoftware;

/**
 * FsoftwareSearch represents the model behind the search form of `frontend\models\Fsoftware`.
 */
class FsoftwareSearch extends Fsoftware
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsoft', 'ideq'], 'integer'],
            [['fsoft'], 'safe'],
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
        $query = Fsoftware::find();

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
            'idsoft' => $this->idsoft,
            'ideq' => $this->ideq,
        ]);

        $query->andFilterWhere(['ilike', 'fsoft', $this->fsoft]);

        return $dataProvider;
    }
}

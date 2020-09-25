<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Direcuser;

/**
 * DirecuserSearch represents the model behind the search form of `frontend\models\Direcuser`.
 */
class DirecuserSearch extends Direcuser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddiruser', 'idfkesta', 'idfkmunc', 'idfkpar', 'idfkciat', 'idfkinst', 'idfkrep'], 'integer'],
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
        $query = Direcuser::find();

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
            'iddiruser' => $this->iddiruser,
            'idfkesta' => $this->idfkesta,
            'idfkmunc' => $this->idfkmunc,
            'idfkpar' => $this->idfkpar,
            'idfkciat' => $this->idfkciat,
            'idfkinst' => $this->idfkinst,
            'idfkrep' => $this->idfkrep,
        ]);

        return $dataProvider;
    }
}

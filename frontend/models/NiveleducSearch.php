<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Niveleduc;

/**
 * NiveleducSearch represents the model behind the search form of `frontend\models\Niveleduc`.
 */
class NiveleducSearch extends Niveleduc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idniv', 'idestu'], 'integer'],
            [['nivel', 'graduado'], 'safe'],
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
        $query = Niveleduc::find();

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
            'idniv' => $this->idniv,
            'idestu' => $this->idestu,
        ]);

        $query->andFilterWhere(['ilike', 'nivel', $this->nivel])
            ->andFilterWhere(['ilike', 'graduado', $this->graduado]);

        return $dataProvider;
    }
}

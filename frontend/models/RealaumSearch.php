<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Realaum;

/**
 * RealaumSearch represents the model behind the search form of `frontend\models\Realaum`.
 */
class RealaumSearch extends Realaum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idra', 'fk_pro', 'fkimag'], 'integer'],
            [['nra', 'exten', 'ruta'], 'safe'],
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
        $query = Realaum::find();

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
            'idra' => $this->idra,
            'fk_pro' => $this->fk_pro,
            'fkimag' => $this->fkimag,
        ]);

        $query->andFilterWhere(['ilike', 'nra', $this->nra])
            ->andFilterWhere(['ilike', 'exten', $this->exten])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta]);

        return $dataProvider;
    }
}

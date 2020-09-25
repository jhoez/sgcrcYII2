<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Fteclado;

/**
 * FtecladoSearch represents the model behind the search form of `frontend\models\Fteclado`.
 */
class FtecladoSearch extends Fteclado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtec', 'ideq'], 'integer'],
            [['ftec'], 'safe'],
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
        $query = Fteclado::find();

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
            'idtec' => $this->idtec,
            'ideq' => $this->ideq,
        ]);

        $query->andFilterWhere(['ilike', 'ftec', $this->ftec]);

        return $dataProvider;
    }
}

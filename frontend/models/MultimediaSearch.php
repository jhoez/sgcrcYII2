<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Multimedia;

/**
 * MultimediaSearch represents the model behind the search form of `frontend\models\Multimedia`.
 */
class MultimediaSearch extends Multimedia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmult', 'fkpro'], 'integer'],
            [['nombmult', 'extension', 'tipomult', 'tamanio', 'ruta'], 'safe'],
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
        $query = Multimedia::find();

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
            'idmult' => $this->idmult,
            'fkpro' => $this->fkpro,
        ]);

        $query->andFilterWhere(['ilike', 'nombmult', $this->nombmult])
            ->andFilterWhere(['ilike', 'extension', $this->extension])
            ->andFilterWhere(['ilike', 'tipomult', $this->tipomult])
            ->andFilterWhere(['ilike', 'tamanio', $this->tamanio])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta]);

        return $dataProvider;
    }
}

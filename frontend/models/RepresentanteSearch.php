<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Representante;

/**
 * RepresentanteSearch represents the model behind the search form of `frontend\models\Representante`.
 */
class RepresentanteSearch extends Representante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrep', 'fkciat', 'fkinst', 'fkuser'], 'integer'],
            [['cedula', 'nombre', 'telf'], 'safe'],
            [['docente'], 'boolean'],
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
        $query = Representante::find();

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
            'idrep' => $this->idrep,
            'docente' => $this->docente,
            'fkciat' => $this->fkciat,
            'fkinst' => $this->fkinst,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'cedula', $this->cedula])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'telf', $this->telf]);

        return $dataProvider;
    }
}

<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Asistencia;

/**
 * AsistenciaSearch represents the model behind the search form of `frontend\models\Asistencia`.
 */
class AsistenciaSearch extends Asistencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idasis', 'fkuser'], 'integer'],
            [['fecha', 'horain', 'horaout', 'observacion'], 'safe'],
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
        $query = Asistencia::find();

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
            'idasis' => $this->idasis,
            'fkuser' => $this->fkuser,
            'fecha' => $this->fecha,
            'horain' => $this->horain,
            'horaout' => $this->horaout,
        ]);

        $query->andFilterWhere(['ilike', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}

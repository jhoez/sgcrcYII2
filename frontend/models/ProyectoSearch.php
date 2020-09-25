<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form of `frontend\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpro', 'fkuser'], 'integer'],
            [['nombpro', 'creador', 'colaboracion', 'descripcion', 'create_at', 'update_at'], 'safe'],
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
        $query = Proyecto::find();

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
            'idpro' => $this->idpro,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'nombpro', $this->nombpro])
            ->andFilterWhere(['ilike', 'creador', $this->creador])
            ->andFilterWhere(['ilike', 'colaboracion', $this->colaboracion])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}

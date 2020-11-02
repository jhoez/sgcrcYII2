<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Formato;

/**
 * FormatoSearch represents the model behind the search form of `frontend\models\Formato`.
 */
class FormatoSearch extends Formato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idf', 'fkuser'], 'integer'],
            [['opcion', 'nombf', 'extens', 'ruta', 'tamanio', 'create_at'], 'safe'],
            [['status', 'statusacta'], 'boolean'],
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
        $query = Formato::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['idf'=>SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idf' => $this->idf,
            'statusacta' => $this->statusacta,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'opcion', $this->opcion])
            ->andFilterWhere(['ilike', 'nombf', $this->nombf])
            ->andFilterWhere(['ilike', 'extens', $this->extens])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta])
            ->andFilterWhere(['ilike', 'tamanio', $this->tamanio]);

        return $dataProvider;
    }
}

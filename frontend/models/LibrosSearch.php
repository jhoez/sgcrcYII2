<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Libros;

/**
 * LibrosSearch represents the model behind the search form of `frontend\models\Libros`.
 */
class LibrosSearch extends Libros
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idlib', 'idfkimag'], 'integer'],
            [['nomblib', 'extension', 'ruta', 'coleccion', 'nivel', 'tamanio'], 'safe'],
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
        $query = Libros::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['idlib'=>SORT_DESC]
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
            'idlib' => $this->idlib,
            'idfkimag' => $this->idfkimag,
        ]);

        $query->andFilterWhere(['ilike', 'nomblib', $this->nomblib])
            ->andFilterWhere(['ilike', 'extension', $this->extension])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta])
            ->andFilterWhere(['ilike', 'coleccion', $this->coleccion])
            ->andFilterWhere(['ilike', 'nivel', $this->nivel])
            ->andFilterWhere(['ilike', 'tamanio', $this->tamanio]);

        return $dataProvider;
    }
}

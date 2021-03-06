<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Imagen;

/**
 * ImagenSearch represents the model behind the search form of `frontend\models\Imagen`.
 */
class ImagenSearch extends Imagen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idimag', 'fkuser'], 'integer'],
            [['nombimg', 'extension', 'ruta', 'tamanio', 'tipoimg'], 'safe'],
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
        $query = Imagen::find();

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
            'idimag' => $this->idimag,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'nombimg', $this->nombimg])
            ->andFilterWhere(['ilike', 'extension', $this->extension])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta])
            ->andFilterWhere(['ilike', 'tamanio', $this->tamanio])
            ->andFilterWhere(['ilike', 'tipoimg', $this->tipoimg]);

        return $dataProvider;
    }
}

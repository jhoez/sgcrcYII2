<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Equipo;

/**
 * EquipoSearch represents the model behind the search form of `frontend\models\Equipo`.
 */
class EquipoSearch extends Equipo
{
    public $cedula;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ideq', 'idrep'], 'integer'],
            [['eqserial', 'frecepcion', 'fentrega', 'eqversion', 'eqstatus', 'diagnostico', 'observacion', 'status','cedula'], 'safe'],
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
        $query = Equipo::find()->joinWith(['idrep']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['ideq'=>SORT_DESC]
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
            'ideq' => $this->ideq,
            'frecepcion' => $this->frecepcion,
            'fentrega' => $this->fentrega,
            'idrep' => $this->idrep,
        ]);

        $query->andFilterWhere(['ilike', 'eqserial', $this->eqserial])
            ->andFilterWhere(['ilike', 'eqversion', $this->eqversion])
            ->andFilterWhere(['ilike', 'eqstatus', $this->eqstatus])
            ->andFilterWhere(['ilike', 'diagnostico', $this->diagnostico])
            ->andFilterWhere(['ilike', 'observacion', $this->observacion])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'cedula', $this->cedula]);

        return $dataProvider;
    }
}

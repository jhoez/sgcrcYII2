<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Realaum;
use frontend\models\Usuario;

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
            [['nombpro'], 'string','max'=>255],
            [['creador'], 'string','max'=>50],
            [['idra', 'idpro', 'fkimag'], 'integer'],
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
            'sort' => [
                'defaultOrder'=>['idra'=>SORT_DESC]
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
            'idra' => $this->idra,
            'idpro' => $this->idpro,
            'fkimag' => $this->fkimag,
        ]);

        // encerrar en un if para preguntar si el usuario logeado es superuser, administrador y tutor
        //$user = Usuario::findOne(Yii::$app->user->getId());

        $query->andFilterWhere(['ilike', 'nra', $this->nra])
            ->andFilterWhere(['ilike', 'exten', $this->exten])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta])
            ->andFilterWhere(['ilike', 'nombpro', $this->nombpro])
            ->andFilterWhere(['ilike', 'creador', $this->creador]);
            //->andFilterWhere(['ilike', 'fkuser', $user->iduser]);

        return $dataProvider;
    }
}

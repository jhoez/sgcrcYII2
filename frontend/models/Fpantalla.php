<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fpantalla".
 *
 * @property int $idpant
 * @property string|null $fpant
 * @property int|null $fkeq
 */
class Fpantalla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fpantalla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkeq'], 'default', 'value' => null],
            [['fkeq'], 'integer'],
            [['fpant'], 'string', 'max' => 255],
            [['fkeq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['fkeq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpant' => 'Idpant',
            'fpant' => 'Falla de pantalla',
            'fkeq' => 'Ideq',
        ];
    }

    public function getFpantequipo()
    {
        $equipo = Equipo::find()->where(['ideq'=>$this->fkeq])->one();
        return $equipo;
    }
}

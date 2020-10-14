<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fpantalla".
 *
 * @property int $idpant
 * @property string|null $fpant
 * @property int|null $ideq
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
            [['ideq'], 'default', 'value' => null],
            [['ideq'], 'integer'],
            [['fpant'], 'string', 'max' => 255],
            [['ideq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['ideq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpant' => 'Idpant',
            'fpant' => 'Fpant',
            'ideq' => 'Ideq',
        ];
    }

    public function getFpantequipo()
    {
        $equipo = Equipo::find()->where(['ideq'=>'ideq'])->one();
        return $equipo;
    }
}

<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fcarga".
 *
 * @property int $idcarg
 * @property string|null $fcarg
 * @property int|null $fkeq
 */
class Fcarga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fcarga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkeq'], 'default', 'value' => null],
            [['fkeq'], 'integer'],
            [['fcarg'], 'string', 'max' => 255],
            [['fkeq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['fkeq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcarg' => 'Idcarg',
            'fcarg' => 'Fcarg',
            'fkeq' => 'Ideq',
        ];
    }

    public function getFcargequipo()
    {
        $equipo = Equipo::find()->where(['ideq'=>$this->fkeq])->one();
        return $equipo;
    }
}

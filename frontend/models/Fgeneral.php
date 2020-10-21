<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fgeneral".
 *
 * @property int $idgen
 * @property string|null $fgen
 * @property int|null $ideq
 */
class Fgeneral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fgeneral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkeq'], 'default', 'value' => null],
            [['fkeq'], 'integer'],
            [['fgen'], 'string', 'max' => 255],
            [['fkeq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['fkeq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idgen' => 'Idgen',
            'fgen' => 'Fgen',
            'fkeq' => 'Ideq',
        ];
    }

    public function getFgenequipo()
    {
        $equipo = Equipo::find()->where(['ideq'=>$this->fkeq])->one();
        return $equipo;
    }
}

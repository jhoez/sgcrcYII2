<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.direcuser".
 *
 * @property int $iddiruser
 * @property int|null $fkesta
 * @property int|null $fkmunc
 * @property int|null $fkpar
 * @property int|null $fkciat
 * @property int|null $fkinst
 * @property int|null $fkrep
 */
class Direcuser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.direcuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkesta', 'fkmunc', 'fkpar', 'fkciat', 'fkinst', 'fkrep'], 'default', 'value' => null],
            [['fkesta', 'fkmunc', 'fkpar', 'fkciat', 'fkinst', 'fkrep'], 'integer'],
            [['fkesta'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['fkesta' => 'idesta']],
            [['fkinst'], 'exist', 'skipOnError' => true, 'targetClass' => Insteduc::className(), 'targetAttribute' => ['fkinst' => 'idinst']],
            [['fkmunc'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['fkmunc' => 'idmunc']],
            [['fkpar'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['fkpar' => 'idpar']],
            [['fkrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['fkrep' => 'idrep']],
            [['fkciat'], 'exist', 'skipOnError' => true, 'targetClass' => Sedeciat::className(), 'targetAttribute' => ['fkciat' => 'idciat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddiruser' => 'Iddiruser',
			'fkesta' => 'Estado',
			'fkmunc' => 'Municipio',
			'fkpar' => 'Parroquia',
			'fkinst' => 'Instituto',
			'fkciat' => 'Ciat',
			'fkrep' => 'Representante',
        ];
    }
}

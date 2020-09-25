<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.direcuser".
 *
 * @property int $iddiruser
 * @property int|null $idfkesta
 * @property int|null $idfkmunc
 * @property int|null $idfkpar
 * @property int|null $idfkciat
 * @property int|null $idfkinst
 * @property int|null $idfkrep
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
            [['idfkesta', 'idfkmunc', 'idfkpar', 'idfkciat', 'idfkinst', 'idfkrep'], 'default', 'value' => null],
            [['idfkesta', 'idfkmunc', 'idfkpar', 'idfkciat', 'idfkinst', 'idfkrep'], 'integer'],
            [['idfkesta'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idfkesta' => 'idesta']],
            [['idfkinst'], 'exist', 'skipOnError' => true, 'targetClass' => Insteduc::className(), 'targetAttribute' => ['idfkinst' => 'idinst']],
            [['idfkmunc'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idfkmunc' => 'idmunc']],
            [['idfkpar'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['idfkpar' => 'idpar']],
            [['idfkrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['idfkrep' => 'idrep']],
            [['idfkciat'], 'exist', 'skipOnError' => true, 'targetClass' => Sedeciat::className(), 'targetAttribute' => ['idfkciat' => 'idciat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddiruser' => 'Iddiruser',
			'idfkesta' => 'Estado',
			'idfkmunc' => 'Municipio',
			'idfkpar' => 'Parroquia',
			'idfkinst' => 'Instituto',
			'idfkciat' => 'Ciat',
			'idfkrep' => 'Representante',
        ];
    }
}

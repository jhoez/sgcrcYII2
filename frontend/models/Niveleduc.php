<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.niveleduc".
 *
 * @property int $idniv
 * @property string|null $nivel
 * @property string|null $graduado
 * @property int|null $fkestu
 */
class Niveleduc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.niveleduc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nivel'],'required'],
            [['fkestu'], 'default', 'value' => null],
            [['fkestu'], 'integer'],
            [['nivel'], 'string', 'max' => 20],
            [['graduado'], 'boolean'],
            [['fkestu'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['fkestu' => 'idestu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idniv' => 'ID',
			'nivel' => 'Nivel educativo',
			'graduado' => 'Graduado',
			'fkestu' => 'Idestu',
        ];
    }
}

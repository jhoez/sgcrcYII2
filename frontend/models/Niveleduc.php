<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.niveleduc".
 *
 * @property int $idniv
 * @property string|null $nivel
 * @property string|null $graduado
 * @property int|null $idestu
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
            [['idestu'], 'default', 'value' => null],
            [['idestu'], 'integer'],
            [['nivel'], 'string', 'max' => 20],
            [['graduado'], 'string', 'max' => 1],
            [['idestu'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['idestu' => 'idestu']],
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
			'idestu' => 'Idestu',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Naturaleza".
 *
 * @property int $id_naturaleza
 * @property string $descripcion
 * @property int $activo
 *
 * @property ISPRLevantamientoDetalle[] $iSPRLevantamientoDetalles
 */
class Naturaleza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Naturaleza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_naturaleza' => 'Id Naturaleza',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISPRLevantamientoDetalles()
    {
        return $this->hasMany(ISPRLevantamientoDetalle::className(), ['id_naturaleza' => 'id_naturaleza']);
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Clasificacion".
 *
 * @property int $id_clasificacion
 * @property string $codigo
 * @property string $descripcion
 * @property string $detalle
 * @property int $nivel
 * @property int $activo
 *
 * @property ISPRUPA[] $iSPRUPAs
 */
class Clasificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Clasificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion', 'detalle'], 'string'],
            [['descripcion', 'detalle'], 'required'],
            [['nivel', 'activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_clasificacion' => 'Id Clasificacion',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'detalle' => 'Detalle',
            'nivel' => 'Nivel',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISPRUPAs()
    {
        return $this->hasMany(ISPRUPA::className(), ['id_clasificacion' => 'id_clasificacion']);
    }
}

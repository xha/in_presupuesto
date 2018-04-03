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
            [['descripcion', 'detalle', 'nivel','codigo'], 'required'],
            [['descripcion', 'detalle'], 'string'],
            [['nivel', 'padre', 'activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_clasificacion' => 'Id',
            'codigo' => 'Codigo ONAPRE',
            'descripcion' => 'Descripcion',
            'detalle' => 'Detalle',
            'nivel' => 'Nivel',
            'padre' => 'Padre',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUPAs()
    {
        return $this->hasMany(UPA::className(), ['id_clasificacion' => 'id_clasificacion']);
    }
    
    public function getIdPadre()
    {
        return $this->hasOne(Clasificacion::className(), ['id_clasificacion' => 'padre']);
    }
}

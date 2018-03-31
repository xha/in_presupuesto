<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Unidad".
 *
 * @property int $id_unidad
 * @property string $descripcion
 * @property int $principal
 * @property string $responsable
 * @property int $activo
 *
 * @property Unidad $unidad
 * @property Unidad $unidad0
 * @property ISPRUnidadConexion $iSPRUnidadConexion
 * @property ISPRUsuario[] $iSPRUsuarios
 */
class Unidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Unidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion','nivel'], 'required'],
            [['descripcion', 'responsable'], 'string'],
            [['nivel', 'activo'], 'integer'],
            [['padre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_unidad' => 'Código',
            'descripcion' => 'Descripcion',
            'nivel' => 'Nivel',
            'padre' => 'Padre',
            'responsable' => 'Responsable',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadConexion()
    {
        return $this->hasOne(ISPRUnidadConexion::className(), ['id_unidad' => 'id_unidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(ISPRUsuario::className(), ['id_unidad' => 'id_unidad']);
    }
}

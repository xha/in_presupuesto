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
            [['descripcion'], 'required'],
            [['descripcion', 'responsable'], 'string'],
            [['principal', 'activo'], 'integer'],
            [['id_unidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['id_unidad' => 'id_unidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_unidad' => 'Id Unidad',
            'descripcion' => 'Descripcion',
            'principal' => 'Principal',
            'responsable' => 'Responsable',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidad()
    {
        return $this->hasOne(Unidad::className(), ['id_unidad' => 'id_unidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidad0()
    {
        return $this->hasOne(Unidad::className(), ['id_unidad' => 'id_unidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISPRUnidadConexion()
    {
        return $this->hasOne(ISPRUnidadConexion::className(), ['id_unidad' => 'id_unidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISPRUsuarios()
    {
        return $this->hasMany(ISPRUsuario::className(), ['id_unidad' => 'id_unidad']);
    }
}

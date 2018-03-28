<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ISPR_UnidadConexion".
 *
 * @property string $base_datos
 * @property string $usuario
 * @property string $clave
 * @property string $ip
 * @property int $puerto
 * @property int $id_unidad
 * @property int $activo
 *
 * @property ISPRUnidad $unidad
 */
class UnidadConexion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_UnidadConexion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['base_datos', 'usuario', 'clave', 'ip'], 'required'],
            [['base_datos', 'usuario', 'clave', 'ip'], 'string'],
            [['puerto', 'id_unidad', 'activo'], 'integer'],
            [['id_unidad'], 'unique'],
            [['id_unidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['id_unidad' => 'id_unidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'base_datos' => 'Base Datos',
            'usuario' => 'Usuario',
            'clave' => 'Clave',
            'ip' => 'Ip',
            'puerto' => 'Puerto',
            'id_unidad' => 'Id Unidad',
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
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Registro".
 *
 * @property string $id_registro
 * @property int $id_usuario
 * @property string $comentario
 * @property string $fecha
 * @property string $ip
 * @property string $estacion
 * @property string $tabla
 */
class Registro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'comentario', 'ip'], 'required'],
            [['id_usuario'], 'integer'],
            [['comentario', 'ip', 'estacion', 'tabla'], 'string'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_registro' => 'Id Registro',
            'id_usuario' => 'Id Usuario',
            'comentario' => 'Comentario',
            'fecha' => 'Fecha',
            'ip' => 'Ip',
            'estacion' => 'Estacion',
            'tabla' => 'Tabla',
        ];
    }
}

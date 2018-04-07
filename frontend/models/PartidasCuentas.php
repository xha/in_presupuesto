<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Partidas_CtasC".
 *
 * @property int $id_pc
 * @property string $id_partida
 * @property string $descripcion_partida
 * @property string $id_cuenta
 * @property string $descripcion_cuenta
 * @property int $nrolinea
 * @property int $relacion
 * @property int $activo
 *
 * @property ISPRPartida $partida
 */
class PartidasCuentas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Partidas_CtasC';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'id_cuenta'], 'required'],
            [['id_partida', 'descripcion_partida', 'id_cuenta', 'descripcion_cuenta'], 'string'],
            [['nrolinea', 'relacion', 'activo'], 'integer'],
            [['id_partida'], 'exist', 'skipOnError' => true, 'targetClass' => Partida::className(), 'targetAttribute' => ['id_partida' => 'id_partida']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pc' => 'Id',
            'id_partida' => 'Partida',
            'descripcion_partida' => 'Descripción Partida',
            'id_cuenta' => 'Cuenta',
            'descripcion_cuenta' => 'Descripción Cuenta',
            'nrolinea' => 'Nro Linea',
            'relacion' => 'Relación',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartida()
    {
        return $this->hasOne(Partida::className(), ['id_partida' => 'id_partida']);
    }
}

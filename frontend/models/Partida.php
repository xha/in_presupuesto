<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Partida".
 *
 * @property string $id_partida
 * @property string $partida
 * @property string $generica
 * @property string $especifica
 * @property string $subEspecifica
 * @property string $denominacion
 * @property string $descripcion
 * @property int $activo
 * @property int $movimiento
 *
 * @property ISPRUPA[] $iSPRUPAs
 */
class Partida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'partida', 'generica', 'especifica', 'subEspecifica', 'denominacion', 'descripcion'], 'required'],
            [['id_partida', 'partida', 'generica', 'especifica', 'subEspecifica', 'denominacion', 'descripcion'], 'string'],
            [['activo', 'movimiento'], 'integer'],
            [['id_partida'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_partida' => 'Id Partida',
            'partida' => 'Partida',
            'generica' => 'Generica',
            'especifica' => 'Especifica',
            'subEspecifica' => 'Sub Especifica',
            'denominacion' => 'Denominacion',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
            'movimiento' => 'Movimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISPRUPAs()
    {
        return $this->hasMany(ISPRUPA::className(), ['id_partida' => 'id_partida']);
    }
}
<?php

namespace frontend\models;

use Yii;
use backend\Models\Unidad;

/**
 * This is the model class for table "ISPR_LevantamientoDetalle".
 *
 * @property int $id_detalle
 * @property int $id_levantamiento
 * @property int $id_naturaleza
 * @property string $id_partida
 * @property int $id_clasificacion
 * @property string $descripcion_clasificacion
 * @property string $descripcion_partida
 * @property string $rubro
 * @property string $cantidad
 * @property string $precio
 * @property string $total
 * @property int $mes
 * @property int $activo
 *
 * @property ISPRClasificacion $clasificacion
 * @property ISPRPartida $partida
 * @property ISPRNaturaleza $naturaleza
 * @property ISPRLevantamiento $levantamiento
 */
class LevantamientoDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_LevantamientoDetalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_levantamiento', 'id_naturaleza', 'id_partida', 'id_clasificacion', 'rubro'], 'required'],
            [['id_levantamiento', 'id_naturaleza', 'id_clasificacion', 'activo'], 'integer'],
            [['id_partida', 'descripcion_clasificacion', 'descripcion_partida', 'rubro', 'mes'], 'string'],
            [['cantidad', 'precio', 'total'], 'number'],
            [['id_clasificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Clasificacion::className(), 'targetAttribute' => ['id_clasificacion' => 'id_clasificacion']],
            [['id_partida'], 'exist', 'skipOnError' => true, 'targetClass' => Partida::className(), 'targetAttribute' => ['id_partida' => 'id_partida']],
            [['id_naturaleza'], 'exist', 'skipOnError' => true, 'targetClass' => Naturaleza::className(), 'targetAttribute' => ['id_naturaleza' => 'id_naturaleza']],
            [['id_levantamiento'], 'exist', 'skipOnError' => true, 'targetClass' => Levantamiento::className(), 'targetAttribute' => ['id_levantamiento' => 'id_levantamiento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => 'Id Detalle',
            'id_levantamiento' => 'Id Levantamiento',
            'id_naturaleza' => 'Id Naturaleza',
            'id_partida' => 'Id Partida',
            'id_clasificacion' => 'Id Clasificacion',
            'descripcion_clasificacion' => 'Descripcion Clasificacion',
            'descripcion_partida' => 'Descripcion Partida',
            'rubro' => 'Rubro',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'total' => 'Total',
            'mes' => 'Mes',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClasificacion()
    {
        return $this->hasOne(Clasificacion::className(), ['id_clasificacion' => 'id_clasificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida()
    {
        return $this->hasOne(Partida::className(), ['id_partida' => 'id_partida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNaturaleza()
    {
        return $this->hasOne(Naturaleza::className(), ['id_naturaleza' => 'id_naturaleza']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLevantamiento()
    {
        return $this->hasOne(Levantamiento::className(), ['id_levantamiento' => 'id_levantamiento']);
    }
}

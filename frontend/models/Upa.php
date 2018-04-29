<?php

namespace frontend\models;

use Yii;
use backend\Models\Unidad;

/**
 * This is the model class for table "ISPR_UPA".
 *
 * @property string $id_upa
 * @property string $id_partida
 * @property string $denominacion_partida
 * @property int $id_clasificacion
 * @property string $descripcion_clasificacion
 * @property int $id_unidad
 * @property string $monto
 * @property string $fecha
  * @property int $asignacion
 * @property string $tipo_operacion
 *
 * @property ISPRClasificacion $clasificacion
 * @property ISPRPartida $partida
 */
class Upa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $total;
    public static function tableName()
    {
        return 'ISPR_UPA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'id_clasificacion', 'descripcion_clasificacion', 'id_unidad', 'asignacion', 'tipo_operacion'], 'required'],
            [['id_partida', 'denominacion_partida', 'descripcion_clasificacion', 'tipo_operacion'], 'string'],
            [['id_clasificacion', 'id_unidad', 'signo'], 'integer'],
            [['asignacion'], 'integer', 'min' => 2019, 'max' => 2040],
            [['monto', 'total'], 'number'],
            [['fecha'], 'safe'],
            [['id_clasificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Clasificacion::className(), 'targetAttribute' => ['id_clasificacion' => 'id_clasificacion']],
            [['id_partida'], 'exist', 'skipOnError' => true, 'targetClass' => Partida::className(), 'targetAttribute' => ['id_partida' => 'id_partida']],
            [['id_unidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['id_unidad' => 'id_unidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_upa' => 'Id Upa',
            'id_partida' => 'Partida',
            'denominacion_partida' => 'Denominación Partida',
            'id_clasificacion' => 'Clasificación',
            'descripcion_clasificacion' => 'Descripción Clasificacion',
            'id_unidad' => 'Unidad',
            'monto' => 'Monto',
            'fecha' => 'Fecha',
            'asignacion' => 'Asignación',
            'tipo_operacion' => 'Tipo Operación',
            'Total' => 'Total',
            'signo' => 'Signo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasificacion()
    {
        return $this->hasOne(Clasificacion::className(), ['id_clasificacion' => 'id_clasificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartida()
    {
        return $this->hasOne(Partida::className(), ['id_partida' => 'id_partida']);
    }

    public function getUnidad()
    {
        return $this->hasOne(Unidad::className(), ['id_unidad' => 'id_unidad']);
    }
}

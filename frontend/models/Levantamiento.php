<?php

namespace frontend\models;

use Yii;
use backend\Models\Unidad;
/**
 * This is the model class for table "ISPR_Levantamiento".
 *
 * @property int $id_levantamiento
 * @property int $id_unidad
 * @property string $fecha
 * @property string $total
 * @property int $activo
 *
 * @property ISPRUnidad $unidad
 * @property ISPRLevantamientoDetalle[] $iSPRLevantamientoDetalles
 */
class Levantamiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $id_unidad_medida;
    public $id_naturaleza;
    public $id_partida;
    public $id_clasificación;
    public $mes;
    public $id_clasificacion;
    public static function tableName()
    {
        return 'ISPR_Levantamiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unidad'], 'required'],
            [['id_unidad', 'activo'], 'integer'],
            [['fecha'], 'safe'],
            [['total'], 'number'],
            [['id_unidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['id_unidad' => 'id_unidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_levantamiento' => 'Id',
            'id_unidad' => 'Unidad',
            'fecha' => 'Fecha',
            'total' => 'Total',
            'activo' => 'Cerrar Levantamiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidad()
    {
        return $this->hasOne(Unidad::className(), ['id_unidad' => 'id_unidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLevantamientoDetalles()
    {
        return $this->hasMany(LevantamientoDetalle::className(), ['id_levantamiento' => 'id_levantamiento']);
    }
}

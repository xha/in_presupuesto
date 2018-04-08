<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Transaccion".
 *
 * @property int $id_transaccion
 * @property int $id_transaccionO
 * @property string $nro_control
 * @property string $nro_factura
 * @property string $nro_orden
 * @property string $fecha
 * @property string $fecha_transaccion
 * @property string $CodProv
 * @property string $DescripProv
 * @property string $id_autorizado
 * @property string $nombre_autorizado
 * @property string $concepto
 * @property string $total
 * @property string $tipo
 * @property string $descuento
 * @property int $id_usuario
 * @property int $activo
 *
 * @property ISPRDetalleTransaccion[] $iSPRDetalleTransaccions
 */
class Transaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $id_partida;
    public $id_clasificacion;
    public static function tableName()
    {
        return 'ISPR_Transaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccionO', 'id_usuario', 'activo'], 'integer'],
            [['nro_control', 'nro_factura', 'nro_orden', 'CodProv', 'DescripProv', 'id_autorizado', 'nombre_autorizado', 'concepto', 'tipo'], 'string'],
            [['fecha', 'CodProv', 'DescripProv', 'total', 'tipo', 'id_usuario', 'asignacion'], 'required'],
            [['fecha', 'fecha_transaccion'], 'safe'],
            [['total', 'descuento', 'asignacion'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transaccion' => 'Id',
            'id_transaccionO' => 'Id Transaccion O',
            'nro_control' => 'Nro Control',
            'nro_factura' => 'Nro Factura',
            'nro_orden' => 'Nro Orden',
            'fecha' => 'Fecha',
            'fecha_transaccion' => 'Fecha Transaccion',
            'CodProv' => 'Proveedor',
            'DescripProv' => 'Nombre Proveedor',
            'id_autorizado' => 'Autorizado',
            'nombre_autorizado' => 'Nombre Autorizado',
            'concepto' => 'Concepto',
            'total' => 'Total',
            'tipo' => 'Tipo',
            'descuento' => 'Descuento',
            'id_usuario' => 'Usuario',
            'activo' => 'Activo',
            'asignacion' => 'Período',
            'id_clasificacion' => 'Clasificación',
            'id_partida' => 'Partida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleTransaccions()
    {
        return $this->hasMany(DetalleTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
}

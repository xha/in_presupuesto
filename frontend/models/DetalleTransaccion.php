<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_DetalleTransaccion".
 *
 * @property int $id_detalle
 * @property int $id_transaccion
 * @property string $id_partida
 * @property int $id_clasificacion
 * @property int $id_unidad
 * @property string $descripcion_clasificacion
 * @property string $descripcion_partida
 * @property string $cuenta_contable
 * @property int $asignacion
 * @property string $CodItem
 * @property int $nroLinea
 * @property string $descripcion
 * @property string $observacion
 * @property string $cantidad
 * @property string $monto
 * @property string $montoIL
 * @property string $descuento
 * @property int $signo
 * @property int $activo
 *
 * @property ISPRTransaccion $transaccion
 */
class DetalleTransaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_DetalleTransaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'id_partida', 'id_clasificacion', 'id_unidad', 'cuenta_contable', 'asignacion', 'CodItem', 'nroLinea', 'descripcion', 'observacion'], 'required'],
            [['id_transaccion', 'id_clasificacion', 'id_unidad', 'asignacion', 'nroLinea', 'signo', 'activo'], 'integer'],
            [['id_partida', 'descripcion_clasificacion', 'descripcion_partida', 'cuenta_contable', 'CodItem', 'descripcion', 'observacion'], 'string'],
            [['cantidad', 'monto', 'montoIL', 'descuento'], 'number'],
            [['id_transaccion'], 'exist', 'skipOnError' => true, 'targetClass' => ISPRTransaccion::className(), 'targetAttribute' => ['id_transaccion' => 'id_transaccion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => 'Id Detalle',
            'id_transaccion' => 'Id Transaccion',
            'id_partida' => 'Id Partida',
            'id_clasificacion' => 'Id Clasificacion',
            'id_unidad' => 'Id Unidad',
            'descripcion_clasificacion' => 'Descripcion Clasificacion',
            'descripcion_partida' => 'Descripcion Partida',
            'cuenta_contable' => 'Cuenta Contable',
            'asignacion' => 'Asignacion',
            'CodItem' => 'Cod Item',
            'nroLinea' => 'Nro Linea',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observacion',
            'cantidad' => 'Cantidad',
            'monto' => 'Monto',
            'montoIL' => 'Monto Il',
            'descuento' => 'Descuento',
            'signo' => 'Signo',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccion()
    {
        return $this->hasOne(ISPRTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
}

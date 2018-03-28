<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SATAXES".
 *
 * @property string $CodTaxs
 * @property string $Descrip
 * @property string $MtoTax
 * @property int $Activo
 * @property int $EsFijo
 * @property int $EsReten
 * @property string $CodOper
 * @property int $EsPorct
 * @property int $EsCosto
 * @property int $TipoIVA
 * @property int $EsLibroI
 * @property int $EsPartic
 * @property int $EsTaxVenta
 * @property int $EsTaxCompra
 * @property string $MontoMin
 * @property string $MontoMax
 * @property string $Sustraendo
 */
class Impuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SATAXES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodTaxs'], 'required'],
            [['CodTaxs', 'Descrip', 'CodOper'], 'string'],
            [['MtoTax', 'MontoMin', 'MontoMax', 'Sustraendo'], 'number'],
            [['Activo', 'EsFijo', 'EsReten', 'EsPorct', 'EsCosto', 'TipoIVA', 'EsLibroI', 'EsPartic', 'EsTaxVenta', 'EsTaxCompra'], 'integer'],
            [['CodTaxs'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodTaxs' => 'Código',
            'Descrip' => 'Descripción',
            'MtoTax' => 'Tasa',
            'Activo' => 'Activo',
            'EsFijo' => 'Es Fijo',
            'EsReten' => 'Es Reten',
            'CodOper' => 'Cod Oper',
            'EsPorct' => 'Es Porct',
            'EsCosto' => 'Es Costo',
            'TipoIVA' => 'Tipo Iva',
            'EsLibroI' => 'Es Libro I',
            'EsPartic' => 'Es Partic',
            'EsTaxVenta' => 'Es Tax Venta',
            'EsTaxCompra' => 'Es Tax Compra',
            'MontoMin' => 'Monto Min',
            'MontoMax' => 'Monto Max',
            'Sustraendo' => 'Sustraendo',
        ];
    }
}

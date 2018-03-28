<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAPROV".
 *
 * @property string $CodProv
 * @property string $Descrip
 * @property int $TipoPrv
 * @property int $TipoID3
 * @property int $TipoID
 * @property string $ID3
 * @property string $DescOrder
 * @property string $Clase
 * @property int $Activo
 * @property string $Represent
 * @property string $Direc1
 * @property string $Direc2
 * @property int $Pais
 * @property int $Estado
 * @property int $Ciudad
 * @property int $Municipio
 * @property string $ZipCode
 * @property string $Telef
 * @property string $Movil
 * @property string $Fax
 * @property string $Email
 * @property string $FechaE
 * @property int $EsReten
 * @property int $RetenISLR
 * @property int $DiasCred
 * @property string $Observa
 * @property int $EsMoneda
 * @property string $Saldo
 * @property string $MontoMax
 * @property string $PagosA
 * @property string $PromPago
 * @property string $RetenIVA
 * @property string $FechaUC
 * @property string $MontoUC
 * @property string $NumeroUC
 * @property string $FechaUP
 * @property string $MontoUP
 * @property string $NumeroUP
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAPROV';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProv'], 'required'],
            [['CodProv', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'Movil', 'Fax', 'Email', 'Observa', 'NumeroUC', 'NumeroUP'], 'string'],
            [['TipoPrv', 'TipoID3', 'TipoID', 'Activo', 'Pais', 'Estado', 'Ciudad', 'Municipio', 'EsReten', 'RetenISLR', 'DiasCred', 'EsMoneda'], 'integer'],
            [['FechaE', 'FechaUC', 'FechaUP'], 'safe'],
            [['Saldo', 'MontoMax', 'PagosA', 'PromPago', 'RetenIVA', 'MontoUC', 'MontoUP'], 'number'],
            [['CodProv'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodProv' => 'Código',
            'Descrip' => 'Descripción',
            'TipoPrv' => 'Tipo Prv',
            'TipoID3' => 'Tipo Id3',
            'TipoID' => 'Tipo ID',
            'ID3' => 'RIF',
            'DescOrder' => 'Desc Order',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Represent' => 'Represent',
            'Direc1' => 'Dirección 1',
            'Direc2' => 'Dirección 2',
            'Pais' => 'Pais',
            'Estado' => 'Estado',
            'Ciudad' => 'Ciudad',
            'Municipio' => 'Municipio',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Tlf Local',
            'Movil' => 'Tlf Movil',
            'Fax' => 'Fax',
            'Email' => 'Email',
            'FechaE' => 'Fecha E',
            'EsReten' => 'Es Reten',
            'RetenISLR' => 'Reten Islr',
            'DiasCred' => 'Dias Cred',
            'Observa' => 'Observa',
            'EsMoneda' => 'Es Moneda',
            'Saldo' => 'Saldo',
            'MontoMax' => 'Monto Max',
            'PagosA' => 'Pagos A',
            'PromPago' => 'Prom Pago',
            'RetenIVA' => 'Reten Iva',
            'FechaUC' => 'Fecha Uc',
            'MontoUC' => 'Monto Uc',
            'NumeroUC' => 'Numero Uc',
            'FechaUP' => 'Fecha Up',
            'MontoUP' => 'Monto Up',
            'NumeroUP' => 'Numero Up',
        ];
    }
}

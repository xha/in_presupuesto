<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SACOMP".
 *
 * @property string $CodSucu
 * @property string $TipoCom
 * @property string $NumeroD
 * @property string $CodProv
 * @property int $NroUnico
 * @property string $NroCtrol
 * @property string $CodEsta
 * @property string $CodUsua
 * @property int $Signo
 * @property string $FechaT
 * @property string $OTipo
 * @property string $ONumero
 * @property string $NumeroP
 * @property string $NumeroE
 * @property string $NumeroC
 * @property string $NumeroN
 * @property string $NumeroR
 * @property int $TipoSus
 * @property int $TipoTraE
 * @property string $NroEstable
 * @property string $PtoEmision
 * @property string $AutSRI
 * @property string $FechaP
 * @property string $Moneda
 * @property string $Factor
 * @property string $MontoMEx
 * @property string $CodUbic
 * @property string $Descrip
 * @property string $Direc1
 * @property string $Direc2
 * @property string $ZipCode
 * @property string $Telef
 * @property string $ID3
 * @property string $Monto
 * @property string $OtrosC
 * @property string $MtoTax
 * @property string $Fletes
 * @property string $TGravable
 * @property string $TGravable0
 * @property string $TExento
 * @property string $DesctoP
 * @property string $RetenIVA
 * @property string $FechaI
 * @property string $FechaR
 * @property string $FechaE
 * @property string $FechaV
 * @property string $CancelI
 * @property string $CancelE
 * @property string $CancelT
 * @property string $CancelC
 * @property string $CancelA
 * @property string $CancelG
 * @property string $MtoTotal
 * @property string $Contado
 * @property string $Credito
 * @property string $SaldoAct
 * @property string $MtoPagos
 * @property string $MtoNCredito
 * @property string $MtoNDebito
 * @property string $Descto1
 * @property string $MtoInt1
 * @property string $Descto2
 * @property string $MtoInt2
 * @property string $MtoFinanc
 * @property string $DetalChq
 * @property string $TotalPrd
 * @property string $TotalSrv
 * @property string $OrdenC
 * @property string $CodOper
 * @property int $NGiros
 * @property int $NMeses
 * @property string $Notas1
 * @property string $Notas2
 * @property string $Notas3
 * @property string $Notas4
 * @property string $Notas5
 * @property string $Notas6
 * @property string $Notas7
 * @property string $Notas8
 * @property string $Notas9
 * @property string $Notas10
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SACOMP';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodSucu', 'TipoCom', 'CodProv'], 'required'],
            [['CodSucu', 'TipoCom', 'NumeroD', 'CodProv', 'NroCtrol', 'CodEsta', 'CodUsua', 'OTipo', 'ONumero', 'NumeroP', 'NumeroE', 'NumeroC', 'NumeroN', 'NumeroR', 'NroEstable', 'PtoEmision', 'AutSRI', 'Moneda', 'CodUbic', 'Descrip', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'ID3', 'DetalChq', 'OrdenC', 'CodOper', 'Notas1', 'Notas2', 'Notas3', 'Notas4', 'Notas5', 'Notas6', 'Notas7', 'Notas8', 'Notas9', 'Notas10'], 'string'],
            [['Signo', 'TipoSus', 'TipoTraE', 'NGiros', 'NMeses'], 'integer'],
            [['FechaT', 'FechaP', 'FechaI', 'FechaR', 'FechaE', 'FechaV'], 'safe'],
            [['Factor', 'MontoMEx', 'Monto', 'OtrosC', 'MtoTax', 'Fletes', 'TGravable', 'TGravable0', 'TExento', 'DesctoP', 'RetenIVA', 'CancelI', 'CancelE', 'CancelT', 'CancelC', 'CancelA', 'CancelG', 'MtoTotal', 'Contado', 'Credito', 'SaldoAct', 'MtoPagos', 'MtoNCredito', 'MtoNDebito', 'Descto1', 'MtoInt1', 'Descto2', 'MtoInt2', 'MtoFinanc', 'TotalPrd', 'TotalSrv'], 'number'],
            [['CodProv', 'CodSucu', 'NumeroD', 'TipoCom'], 'unique', 'targetAttribute' => ['CodProv', 'CodSucu', 'NumeroD', 'TipoCom']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodSucu' => 'Sucursal',
            'TipoCom' => 'Tipo',
            'NumeroD' => 'Documento',
            'CodProv' => 'Proveedor',
            'NroUnico' => 'Nro Unico',
            'NroCtrol' => 'Nro Ctrol',
            'CodEsta' => 'Cod Esta',
            'CodUsua' => 'Usuario',
            'Signo' => 'Signo',
            'FechaT' => 'Fecha T',
            'OTipo' => 'Otipo',
            'ONumero' => 'Onumero',
            'NumeroP' => 'Numero P',
            'NumeroE' => 'Numero E',
            'NumeroC' => 'Numero C',
            'NumeroN' => 'Numero N',
            'NumeroR' => 'Numero R',
            'TipoSus' => 'Tipo Sus',
            'TipoTraE' => 'Tipo Tra E',
            'NroEstable' => 'Nro Estable',
            'PtoEmision' => 'Pto Emision',
            'AutSRI' => 'Aut Sri',
            'FechaP' => 'Fecha P',
            'Moneda' => 'Moneda',
            'Factor' => 'Factor',
            'MontoMEx' => 'Monto Mex',
            'CodUbic' => 'Ubicación',
            'Descrip' => 'Razón Social',
            'Direc1' => 'Direc1',
            'Direc2' => 'Direc2',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Teléfono',
            'ID3' => 'RIF',
            'Monto' => 'Monto',
            'OtrosC' => 'Otros C',
            'MtoTax' => 'Mto Tax',
            'Fletes' => 'Fletes',
            'TGravable' => 'Tgravable',
            'TGravable0' => 'Tgravable0',
            'TExento' => 'Texento',
            'DesctoP' => 'Descto P',
            'RetenIVA' => 'Reten Iva',
            'FechaI' => 'Fecha I',
            'FechaR' => 'Fecha R',
            'FechaE' => 'Fecha',
            'FechaV' => 'Fecha V',
            'CancelI' => 'Cancel I',
            'CancelE' => 'Cancel E',
            'CancelT' => 'Cancel T',
            'CancelC' => 'Cancel C',
            'CancelA' => 'Cancel A',
            'CancelG' => 'Cancel G',
            'MtoTotal' => 'Total',
            'Contado' => 'Contado',
            'Credito' => 'Credito',
            'SaldoAct' => 'Saldo Act',
            'MtoPagos' => 'Mto Pagos',
            'MtoNCredito' => 'Mto Ncredito',
            'MtoNDebito' => 'Mto Ndebito',
            'Descto1' => 'Descto1',
            'MtoInt1' => 'Mto Int1',
            'Descto2' => 'Descto2',
            'MtoInt2' => 'Mto Int2',
            'MtoFinanc' => 'Mto Financ',
            'DetalChq' => 'Detal Chq',
            'TotalPrd' => 'Total Prd',
            'TotalSrv' => 'Total Srv',
            'OrdenC' => 'Orden C',
            'CodOper' => 'Cod Oper',
            'NGiros' => 'Ngiros',
            'NMeses' => 'Nmeses',
            'Notas1' => 'Notas1',
            'Notas2' => 'Notas2',
            'Notas3' => 'Notas3',
            'Notas4' => 'Notas4',
            'Notas5' => 'Notas5',
            'Notas6' => 'Notas6',
            'Notas7' => 'Notas7',
            'Notas8' => 'Notas8',
            'Notas9' => 'Notas9',
            'Notas10' => 'Notas10',
        ];
    }
}

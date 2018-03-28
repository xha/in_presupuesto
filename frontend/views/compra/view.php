<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Compra */

$this->title = $model->NumeroD;
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'CodProv' => $model->CodProv, 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoCom' => $model->TipoCom], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Desactivar', ['delete', 'CodProv' => $model->CodProv, 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoCom' => $model->TipoCom], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CodSucu',
            'TipoCom',
            'NumeroD',
            'CodProv',
            'NroUnico',
            'NroCtrol',
            'CodEsta',
            'CodUsua',
            'Signo',
            'FechaT',
            'OTipo',
            'ONumero',
            'NumeroP',
            'NumeroE',
            'NumeroC',
            'NumeroN',
            'NumeroR',
            'TipoSus',
            'TipoTraE',
            'NroEstable',
            'PtoEmision',
            'AutSRI',
            'FechaP',
            'Moneda',
            'Factor',
            'MontoMEx',
            'CodUbic',
            'Descrip',
            'Direc1',
            'Direc2',
            'ZipCode',
            'Telef',
            'ID3',
            'Monto',
            'OtrosC',
            'MtoTax',
            'Fletes',
            'TGravable',
            'TGravable0',
            'TExento',
            'DesctoP',
            'RetenIVA',
            'FechaI',
            'FechaR',
            'FechaE',
            'FechaV',
            'CancelI',
            'CancelE',
            'CancelT',
            'CancelC',
            'CancelA',
            'CancelG',
            'MtoTotal',
            'Contado',
            'Credito',
            'SaldoAct',
            'MtoPagos',
            'MtoNCredito',
            'MtoNDebito',
            'Descto1',
            'MtoInt1',
            'Descto2',
            'MtoInt2',
            'MtoFinanc',
            'DetalChq',
            'TotalPrd',
            'TotalSrv',
            'OrdenC',
            'CodOper',
            'NGiros',
            'NMeses',
            'Notas1',
            'Notas2',
            'Notas3',
            'Notas4',
            'Notas5',
            'Notas6',
            'Notas7',
            'Notas8',
            'Notas9',
            'Notas10',
        ],
    ]) ?>

</div>

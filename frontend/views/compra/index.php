<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\VentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch ($TipoCom) {
    case 'H': $titulo = 'Compra';
    break;
    case 'I': $titulo = 'Devoluciones de Compra';
    break;
    case 'S': $titulo = 'Cotización';
    break;
    case 'J': $titulo = 'Notas de Entrega de Compra';
    break;
    case 'K': $titulo = 'Devoluciones de Notas de Entrega de Compra';
    break;
    default: $titulo = 'Orden de C/S';
}

$this->title = $titulo;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-index">

    <center>
        <?php
            if ($TipoCom=='L') {
                echo Html::a('Crear '.$titulo, ['compra/create?TipoCom='.$TipoCom.'&titulo='.$titulo], ['class' => 'btn btn-success']);
            }
        ?>
    </center>
    <br />
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'CodSucu',
            //'TipoCom',
            'NumeroD',
            //'NroUnico',
            //'NroCtrol',
            //'CodEsta',
            //'CodUsua',
            //'EsCorrel',
            //'CodConv',
            //'Signo',
            //'FechaT',
            //'OTipo',
            //'ONumero',
            //'NumeroC',
            //'NumeroT',
            //'NumeroR',
            //'TipoTraE',
            //'AutSRI',
            //'NroEstable',
            //'PtoEmision',
            //'NumeroF',
            //'NumeroNCF',
            //'NumeroP',
            //'NumeroE',
            //'NumeroZ',
            //'Moneda',
            //'Factor',
            //'MontoMEx',
            'CodProv',
            //'CodVend',
            //'CodUbic',
            'Descrip',
            //'Direc1',
            //'Direc2',
            //'Direc3',
            //'ZipCode',
            //'Telef',
            //'ID3',
            //'Monto',
            //'MtoTax',
            //'Fletes',
            //'TGravable',
            //'TGravable0',
            //'TExento',
            //'CostoPrd',
            //'CostoSrv',
            //'DesctoP',
            //'RetenIVA',
            //'FechaR',
            //'FechaI',
            //'FechaE',
            [
               'attribute' => 'FechaE',
                'format' =>  ['date', 'php:d-m-Y'],
            ],
            //'FechaV',
            'MtoTotal',
            //'Contado',
            //'Credito',
            //'CancelI',
            //'CancelA',
            //'CancelE',
            //'CancelC',
            //'CancelT',
            //'CancelG',
            //'CancelP',
            //'Cambio',
            //'MtoExtra',
            //'ValorPtos',
            //'Descto1',
            //'PctAnual',
            //'MtoInt1',
            //'Descto2',
            //'PctManejo',
            //'MtoInt2',
            //'SaldoAct',
            //'MtoPagos',
            //'MtoNCredito',
            //'MtoNDebito',
            //'MtoFinanc',
            //'DetalChq',
            //'TotalPrd',
            //'TotalSrv',
            //'OrdenC',
            //'CodOper',
            //'NGiros',
            //'NMeses',
            //'MtoComiVta',
            //'MtoComiCob',
            //'MtoComiVtaD',
            //'MtoComiCobD',
            //'Notas1',
            //'Notas2',
            //'Notas3',
            //'Notas4',
            //'Notas5',
            //'Notas6',
            //'Notas7',
            //'Notas8',
            //'Notas9',
            //'Notas10',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'Documento '.$model->NumeroD),
                                    'target' => '_blank',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = Yii::$app->urlManager->createUrl(['compra/update?NumeroD='.$model->NumeroD.'&CodSucu='.$model->CodSucu.'&TipoCom='.$model->TipoCom.'&CodProv='.$model->CodProv]); // your own url generation logic
                        return $url;
                    } else {
                        $url = Yii::$app->urlManager->createUrl(['compra/view?NumeroD='.$model->NumeroD.'&CodSucu='.$model->CodSucu.'&TipoCom='.$model->TipoCom.'&CodProv='.$model->CodProv]); // your own url generation logic
                        return $url;
                    }
                }
                          
            ],
        ],
    ]); ?>
</div>

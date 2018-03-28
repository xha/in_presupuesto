<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\ImpuestoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Impuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impuesto-index">

    <p>
        <?= Html::a('Crear Impuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #EEE'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CodTaxs',
            'Descrip',
            'MtoTax',
            'Activo',
            //'EsFijo',
            //'EsReten',
            //'CodOper',
            //'EsPorct',
            //'EsCosto',
            //'TipoIVA',
            //'EsLibroI',
            //'EsPartic',
            //'EsTaxVenta',
            //'EsTaxCompra',
            //'MontoMin',
            //'MontoMax',
            //'Sustraendo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

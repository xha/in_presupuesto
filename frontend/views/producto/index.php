<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <p>
        <?= Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #EEE'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CodProd',
            'Descrip',
            'CodInst',
            'Activo',
            'Descrip2',
            //'Descrip3',
            //'Refere',
            //'Marca',
            //'Unidad',
            //'UndEmpaq',
            //'CantEmpaq',
            //'Precio1',
            //'Precio2',
            //'PrecioU2',
            //'Precio3',
            //'PrecioU3',
            //'PrecioU',
            //'CostAct',
            //'CostPro',
            //'CostAnt',
            //'Existen',
            //'ExUnidad',
            //'Compro',
            //'Pedido',
            //'Minimo',
            //'Maximo',
            //'Tara',
            //'DEsComp',
            //'DEsComi',
            //'DEsSeri',
            //'EsReten',
            //'DEsLote',
            //'DEsVence',
            //'EsImport',
            //'EsExento',
            //'EsEnser',
            //'EsOferta',
            //'EsPesa',
            //'EsEmpaque',
            //'ExDecimal',
            //'DiasEntr',
            //'FechaUV',
            //'FechaUC',
            //'DiasTole',
            //'Peso',
            //'Volumen',
            //'UndVol',
            //'concentracion',
            //'cantidad_farmacia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

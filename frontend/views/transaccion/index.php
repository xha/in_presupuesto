<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\TransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitud de Compromiso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-index">

    <p>
        <?= Html::a('Crear Nueva Solicitud de Compromiso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_transaccion',
            //'id_transaccionO',
            //'nro_control',
            'nro_orden',
            'nro_factura',
            'fecha',
            //'fecha_transaccion',
            'CodProv',
            //'DescripProv',
            //'id_autorizado',
            //'nombre_autorizado',
            //'concepto',
            'total',
            'tipo',
            //'descuento',
            //'id_usuario',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\TransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaccions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_transaccion',
            'id_transaccionO',
            'nro_control',
            'nro_factura',
            'nro_orden',
            //'fecha',
            //'fecha_transaccion',
            //'CodProv',
            //'DescripProv',
            //'id_autorizado',
            //'nombre_autorizado',
            //'concepto',
            //'total',
            //'tipo',
            //'descuento',
            //'id_usuario',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

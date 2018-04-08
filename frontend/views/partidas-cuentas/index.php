<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\PartidasCuentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidas Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidas-cuentas-index">

    <p>
        <?= Html::a('Crear Partidas Cuentas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_pc',
            'id_partida',
            'descripcion_partida',
            'id_cuenta',
            'descripcion_cuenta',
            //'nrolinea',
            //'relacion',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

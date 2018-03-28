<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\PartidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partida-index">

    <p>
        <?= Html::a('Crear Partida', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #EEE'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_partida',
            'partida',
            'generica',
            'especifica',
            'subEspecifica',
            //'denominacion',
            //'descripcion',
            'activo:boolean',
            //'movimiento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\ClasificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-index">

    <p>
        <?= Html::a('Crear Clasificación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #EEE'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_clasificacion',
            'codigo',
            'descripcion',
            //'detalle',
            'nivel',
            'padre',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

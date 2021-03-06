<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UnidadMedidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unidad de Medida';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-medida-index">

    <p>
        <?= Html::a('Crear Unidad de Medida', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_unidad_medida',
            'descripcion',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

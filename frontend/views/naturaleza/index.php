<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NaturalezaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Naturaleza del Gasto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="naturaleza-index">

    <p>
        <?= Html::a('Crear Naturaleza del Gasto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_naturaleza',
            'descripcion',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificación por Unidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-unidad-index">

    <center>
        <?= Html::a('Crear Clasificacion por Unidad', ['create'], ['class' => 'btn btn-success']) ?>
    </center>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
              'attribute'=>'id_clasificacion',
              'value'=>'idClasificacion.descripcion',
            ],
            [
              'attribute'=>'id_unidad',
              'value'=>'idUnidad.descripcion',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

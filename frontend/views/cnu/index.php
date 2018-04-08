<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\CnuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unión de Producto - Partida Presupuestaria';
$this->params['breadcrumbs'][] = 'Unión';
?>
<div class="cnu-index">

    <p>
        <?= Html::a('Crear Unión', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_cnu',
            /*[
              'attribute'=>'id_partida',
              'value'=>'cnuPartida.descripcion',
              'contentOptions' => ['style' => 'white-space: normal;'],  
            ],*/
            'id_partida',
            'id_cuenta',
            'CodItem',
            'EsServicio:boolean',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

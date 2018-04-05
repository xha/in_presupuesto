<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\CnuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unión de Producto - Partida Pres - Partida Cont';
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
            'id_unidad',
            'id_clasificacion',
            'id_partida',
            'CodItem',
            'EsServicio:boolean',
            //'cuentaC',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

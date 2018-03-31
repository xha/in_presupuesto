<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\UpaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch ($tipo) {
    case 'M': $titulo = 'Asignación';
    break;
    case 'B': $titulo = 'Anteproyecto';
    break;
    default: 
        $titulo = 'Asignación';
}

$this->title = $titulo;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-index">

    <center>
        <?= Html::a('Actualizar '.$titulo, ['upa/create?tipo='.$tipo.'&titulo='.$titulo], ['class' => 'btn btn-success']); ?>
    </center>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_upa',
            //'id_partida',
            //'denominacion_partida',
            //'id_clasificacion',
            //'descripcion_clasificacion',
            //'id_unidad',
            //'fecha',
            //'partida_origen',
            //'asignacion',
            'tipo_operacion',
            'monto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

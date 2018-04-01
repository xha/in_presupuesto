<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UnidadConexionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conexiones a las Unidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-conexion-index">

    <p>
        <?= Html::a('Crear Conexión a la Unidad ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_unidad_conexion',
            'base_datos',
            'usuario',
            //'clave',
            'ip',
            //'puerto',
            'id_unidad',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

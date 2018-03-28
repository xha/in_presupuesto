<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\UbicacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ubicaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-index">

    <p>
        <?= Html::a('Crear Ubicación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CodUbic',
            'Descrip',
            'Clase',
            'Activo',
            'Represent',
            //'Direc1',
            //'Direc2',
            //'ZipCode',
            //'Telef',
            //'Printer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

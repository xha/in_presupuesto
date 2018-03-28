<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\UpaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Upa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_upa',
            'id_partida',
            'denominacion_partida',
            'id_clasificacion',
            'descripcion_clasificacion',
            //'id_unidad',
            //'monto',
            //'fecha',
            //'partida_origen',
            //'asignacion',
            //'tipo_operacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

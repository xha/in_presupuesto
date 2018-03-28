<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\PartidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partida-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Partida', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_partida',
            'partida',
            'generica',
            'especifica',
            'subEspecifica',
            //'denominacion',
            //'descripcion',
            //'activo',
            //'movimiento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

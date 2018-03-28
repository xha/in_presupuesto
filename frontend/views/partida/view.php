<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */

$this->title = $model->id_partida;
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partida-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_partida], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_partida], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_partida',
            'partida',
            'generica',
            'especifica',
            'subEspecifica',
            'denominacion',
            //'descripcion',
            'activo:boolean',
            'movimiento',
        ],
    ]) ?>

</div>

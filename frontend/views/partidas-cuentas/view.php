<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidasCuentas */

$this->title = $model->id_pc;
$this->params['breadcrumbs'][] = ['label' => 'Partidas Cuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidas-cuentas-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_pc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_pc], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pc',
            'id_partida',
            'descripcion_partida',
            'id_cuenta',
            'descripcion_cuenta',
            'nrolinea',
            'relacion',
            'activo',
        ],
    ]) ?>

</div>

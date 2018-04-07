<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidasCuentas */

$this->title = 'Actualizar Partidas Cuentas: ' . $model->id_pc;
$this->params['breadcrumbs'][] = ['label' => 'Partidas Cuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pc, 'url' => ['view', 'id' => $model->id_pc]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="partidas-cuentas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
    ]) ?>

</div>

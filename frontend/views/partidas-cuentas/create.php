<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidasCuentas */

$this->title = 'Crear Partidas Cuentas';
$this->params['breadcrumbs'][] = ['label' => 'Partidas Cuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidas-cuentas-create">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
    ]) ?>

</div>

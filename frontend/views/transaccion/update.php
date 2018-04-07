<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */

$this->title = 'Actualizar Transacción: ' . $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transaccion, 'url' => ['view', 'id' => $model->id_transaccion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="transaccion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */

$this->title = 'Solicitud de Compromiso';
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-create">

    <?= $this->render('_form', [
        'model' => $model,
        'asignacion' => $asignacion,
    ]) ?>

</div>

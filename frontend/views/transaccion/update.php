<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */

$this->title = 'Update Transaccion: ' . $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transaccion, 'url' => ['view', 'id' => $model->id_transaccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

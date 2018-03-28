<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Impuesto */

$this->title = 'Actualizar Impuesto: ' . $model->CodTaxs;
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodTaxs, 'url' => ['view', 'id' => $model->CodTaxs]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="impuesto-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

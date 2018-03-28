<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\Models\Unidad */

$this->title = 'Actualizar Unidad: ' . $model->id_unidad;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unidad, 'url' => ['view', 'id' => $model->id_unidad]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="unidad-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

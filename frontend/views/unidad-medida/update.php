<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UnidadMedida */

$this->title = 'Actualizar Unidad de Medida: ' . $model->id_unidad_medida;
$this->params['breadcrumbs'][] = ['label' => 'Unidad de Medida', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unidad_medida, 'url' => ['view', 'id' => $model->id_unidad_medida]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="unidad-medida-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

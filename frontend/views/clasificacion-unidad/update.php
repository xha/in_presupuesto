<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClasificacionUnidad */

$this->title = 'Actualizar Clasificacion Unidad: ' . $model->id_clasificacion;
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_clasificacion, 'url' => ['view', 'id_clasificacion' => $model->id_clasificacion, 'id_unidad' => $model->id_unidad]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="clasificacion-unidad-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

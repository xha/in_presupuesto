<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */

$this->title = 'Actualizar Clasificación: ' . $model->id_clasificacion;
$this->params['breadcrumbs'][] = ['label' => 'Clasificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_clasificacion, 'url' => ['view', 'id' => $model->id_clasificacion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="clasificacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

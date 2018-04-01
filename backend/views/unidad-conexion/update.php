<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UnidadConexion */

$this->title = 'Actualizar Conexión a la Unidad: ' . $model->id_unidad_conexion;
$this->params['breadcrumbs'][] = ['label' => 'Conexión a la Unidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unidad_conexion, 'url' => ['view', 'id' => $model->id_unidad_conexion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="unidad-conexion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UnidadConexion */

$this->title = 'Crear Conexion a la Unidad';
$this->params['breadcrumbs'][] = ['label' => 'Unidad Conexions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-conexion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

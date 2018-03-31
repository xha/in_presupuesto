<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ClasificacionUnidad */

$this->title = 'Crear Clasificación por Unidad';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clasificacion-unidad-create">

    <?= $this->render('_form', [
        'model' => $model,
        'nivel_unidad' => $nivel_unidad,
        'nivel_clasificacion' => $nivel_clasificacion,
    ]) ?>

</div>

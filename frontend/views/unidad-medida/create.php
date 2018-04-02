<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UnidadMedida */

$this->title = 'Crear Unidad de Medida';
$this->params['breadcrumbs'][] = ['label' => 'Unidad de Medida', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-medida-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

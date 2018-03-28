<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Ubicacion */

$this->title = 'Actualizar Ubicación: ' . $model->CodUbic;
$this->params['breadcrumbs'][] = ['label' => 'Ubicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodUbic, 'url' => ['view', 'id' => $model->CodUbic]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ubicacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

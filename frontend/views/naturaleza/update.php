<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Naturaleza */

$this->title = 'Actualizar Naturaleza del Gasto: ' . $model->id_naturaleza;
$this->params['breadcrumbs'][] = ['label' => 'Naturaleza del Gasto', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_naturaleza, 'url' => ['view', 'id' => $model->id_naturaleza]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="naturaleza-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

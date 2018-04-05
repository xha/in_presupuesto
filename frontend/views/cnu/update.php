<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Cnu */

$this->title = 'Actualizar Unión: ' . $model->id_cnu;
$this->params['breadcrumbs'][] = ['label' => 'Unión', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cnu, 'url' => ['view', 'id' => $model->id_cnu]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="cnu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

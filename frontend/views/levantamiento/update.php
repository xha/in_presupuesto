<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Levantamiento */

$this->title = 'Actualizar Levantamiento de Información: ' . $model->id_levantamiento;
$this->params['breadcrumbs'][] = ['label' => 'Levantamiento de Información', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_levantamiento, 'url' => ['view', 'id' => $model->id_levantamiento]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="levantamiento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

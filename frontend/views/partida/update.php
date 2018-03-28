<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */

$this->title = 'Update Partida: ' . $model->id_partida;
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_partida, 'url' => ['view', 'id' => $model->id_partida]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partida-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

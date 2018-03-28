<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */

$this->title = 'Crear Partida';
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partida-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

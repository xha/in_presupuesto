<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Levantamiento */

$this->title = 'Crear Levantamiento de Información';
$this->params['breadcrumbs'][] = ['label' => 'Levantamiento de Información', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="levantamiento-create">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
        'clasificacion' => $clasificacion,
    ]) ?>

</div>

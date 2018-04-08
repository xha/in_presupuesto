<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Cnu */

$this->title = 'Crear Unión';
$this->params['breadcrumbs'][] = ['label' => 'Unión', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
    ]) ?>

</div>

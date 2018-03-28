<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Impuesto */

$this->title = 'Crear Impuesto';
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impuesto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

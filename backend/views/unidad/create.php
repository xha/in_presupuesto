<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\Models\Unidad */

$this->title = 'Crear Unidad';
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

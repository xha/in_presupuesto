<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */

$this->title = 'Crear Clasificación';
$this->params['breadcrumbs'][] = ['label' => 'Clasificación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

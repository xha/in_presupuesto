<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */

$this->title = 'Update Clasificacion: ' . $model->id_clasificacion;
$this->params['breadcrumbs'][] = ['label' => 'Clasificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_clasificacion, 'url' => ['view', 'id' => $model->id_clasificacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clasificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

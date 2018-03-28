<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Empresa */

$this->title = 'Actualizar Empresa: ' . $model->id_empresa;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_empresa, 'url' => ['view', 'id' => $model->id_empresa]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="empresa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

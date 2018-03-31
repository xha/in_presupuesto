<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

$this->title = 'Actualizar : ' . $model->id_upa;
$this->params['breadcrumbs'][] = ['label' => 'Formulación', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_upa, 'url' => ['view', 'id' => $model->id_upa]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="upa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

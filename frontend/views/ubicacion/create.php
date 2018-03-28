<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Ubicacion */

$this->title = 'Crear Ubicacion';
$this->params['breadcrumbs'][] = ['label' => 'Ubicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Naturaleza */

$this->title = 'Crear Naturaleza del Gasto';
$this->params['breadcrumbs'][] = ['label' => 'Naturaleza del Gasto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="naturaleza-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */

$this->title = 'Create Clasificacion';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

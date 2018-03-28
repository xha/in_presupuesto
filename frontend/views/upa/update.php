<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

$this->title = 'Update Upa: ' . $model->id_upa;
$this->params['breadcrumbs'][] = ['label' => 'Upas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_upa, 'url' => ['view', 'id' => $model->id_upa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="upa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

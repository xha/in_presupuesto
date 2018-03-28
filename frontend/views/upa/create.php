<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

$this->title = 'Create Upa';
$this->params['breadcrumbs'][] = ['label' => 'Upas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

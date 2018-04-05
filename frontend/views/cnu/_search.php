<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\CnuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cnu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_cnu') ?>

    <?= $form->field($model, 'id_unidad') ?>

    <?= $form->field($model, 'id_clasificacion') ?>

    <?= $form->field($model, 'id_partida') ?>

    <?= $form->field($model, 'CodItem') ?>

    <?php // echo $form->field($model, 'EsServicio') ?>

    <?php // echo $form->field($model, 'cuentaC') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

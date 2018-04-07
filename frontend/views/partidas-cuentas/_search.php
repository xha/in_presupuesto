<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidasCuentasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partidas-cuentas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pc') ?>

    <?= $form->field($model, 'id_partida') ?>

    <?= $form->field($model, 'descripcion_partida') ?>

    <?= $form->field($model, 'id_cuenta') ?>

    <?= $form->field($model, 'descripcion_cuenta') ?>

    <?php // echo $form->field($model, 'nrolinea') ?>

    <?php // echo $form->field($model, 'relacion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

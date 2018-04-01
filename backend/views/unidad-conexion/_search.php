<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UnidadConexionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidad-conexion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_unidad_conexion') ?>

    <?= $form->field($model, 'base_datos') ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'puerto') ?>

    <?php // echo $form->field($model, 'id_unidad') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

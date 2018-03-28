<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\UpaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_upa') ?>

    <?= $form->field($model, 'id_partida') ?>

    <?= $form->field($model, 'denominacion_partida') ?>

    <?= $form->field($model, 'id_clasificacion') ?>

    <?= $form->field($model, 'descripcion_clasificacion') ?>

    <?php // echo $form->field($model, 'id_unidad') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'partida_origen') ?>

    <?php // echo $form->field($model, 'asignacion') ?>

    <?php // echo $form->field($model, 'tipo_operacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

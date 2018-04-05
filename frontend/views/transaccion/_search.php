<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\TransaccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_transaccion') ?>

    <?= $form->field($model, 'id_transaccionO') ?>

    <?= $form->field($model, 'nro_control') ?>

    <?= $form->field($model, 'nro_factura') ?>

    <?= $form->field($model, 'nro_orden') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'fecha_transaccion') ?>

    <?php // echo $form->field($model, 'CodProv') ?>

    <?php // echo $form->field($model, 'DescripProv') ?>

    <?php // echo $form->field($model, 'id_autorizado') ?>

    <?php // echo $form->field($model, 'nombre_autorizado') ?>

    <?php // echo $form->field($model, 'concepto') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'descuento') ?>

    <?php // echo $form->field($model, 'id_usuario') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

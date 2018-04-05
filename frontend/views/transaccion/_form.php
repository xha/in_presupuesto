<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_transaccionO')->textInput() ?>

    <?= $form->field($model, 'nro_control')->textInput() ?>

    <?= $form->field($model, 'nro_factura')->textInput() ?>

    <?= $form->field($model, 'nro_orden')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'fecha_transaccion')->textInput() ?>

    <?= $form->field($model, 'CodProv')->textInput() ?>

    <?= $form->field($model, 'DescripProv')->textInput() ?>

    <?= $form->field($model, 'id_autorizado')->textInput() ?>

    <?= $form->field($model, 'nombre_autorizado')->textInput() ?>

    <?= $form->field($model, 'concepto')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'descuento')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

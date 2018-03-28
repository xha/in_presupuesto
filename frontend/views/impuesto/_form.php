<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Impuesto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="impuesto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodTaxs')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'MtoTax')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

    <?= $form->field($model, 'EsFijo')->textInput() ?>

    <?= $form->field($model, 'EsReten')->textInput() ?>

    <?= $form->field($model, 'CodOper')->textInput() ?>

    <?= $form->field($model, 'EsPorct')->textInput() ?>

    <?= $form->field($model, 'EsCosto')->textInput() ?>

    <?= $form->field($model, 'TipoIVA')->textInput() ?>

    <?= $form->field($model, 'EsLibroI')->textInput() ?>

    <?= $form->field($model, 'EsPartic')->textInput() ?>

    <?= $form->field($model, 'EsTaxVenta')->textInput() ?>

    <?= $form->field($model, 'EsTaxCompra')->textInput() ?>

    <?= $form->field($model, 'MontoMin')->textInput() ?>

    <?= $form->field($model, 'MontoMax')->textInput() ?>

    <?= $form->field($model, 'Sustraendo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

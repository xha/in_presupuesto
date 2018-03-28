<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\ImpuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="impuesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodTaxs') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'MtoTax') ?>

    <?= $form->field($model, 'Activo') ?>

    <?= $form->field($model, 'EsFijo') ?>

    <?php // echo $form->field($model, 'EsReten') ?>

    <?php // echo $form->field($model, 'CodOper') ?>

    <?php // echo $form->field($model, 'EsPorct') ?>

    <?php // echo $form->field($model, 'EsCosto') ?>

    <?php // echo $form->field($model, 'TipoIVA') ?>

    <?php // echo $form->field($model, 'EsLibroI') ?>

    <?php // echo $form->field($model, 'EsPartic') ?>

    <?php // echo $form->field($model, 'EsTaxVenta') ?>

    <?php // echo $form->field($model, 'EsTaxCompra') ?>

    <?php // echo $form->field($model, 'MontoMin') ?>

    <?php // echo $form->field($model, 'MontoMax') ?>

    <?php // echo $form->field($model, 'Sustraendo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

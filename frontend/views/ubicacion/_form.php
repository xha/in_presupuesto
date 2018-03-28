<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Ubicacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubicacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodUbic')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'Clase')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

    <?= $form->field($model, 'Represent')->textInput() ?>

    <?= $form->field($model, 'Direc1')->textInput() ?>

    <?= $form->field($model, 'Direc2')->textInput() ?>

    <?= $form->field($model, 'ZipCode')->textInput() ?>

    <?= $form->field($model, 'Telef')->textInput() ?>

    <?= $form->field($model, 'Printer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

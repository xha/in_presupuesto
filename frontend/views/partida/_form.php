<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partida-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_partida')->textInput() ?>

    <?= $form->field($model, 'partida')->textInput() ?>

    <?= $form->field($model, 'generica')->textInput() ?>

    <?= $form->field($model, 'especifica')->textInput() ?>

    <?= $form->field($model, 'subEspecifica')->textInput() ?>

    <?= $form->field($model, 'denominacion')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'movimiento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

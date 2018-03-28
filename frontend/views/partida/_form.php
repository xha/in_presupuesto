<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partida-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <center class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'id_partida')->textInput() ?>

    <?= $form->field($model, 'partida')->textInput() ?>

    <?= $form->field($model, 'generica')->textInput() ?>

    <?= $form->field($model, 'especifica')->textInput() ?>

    <?= $form->field($model, 'subEspecifica')->textInput() ?>

    <?= $form->field($model, 'denominacion')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

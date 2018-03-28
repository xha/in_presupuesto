<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_partida')->textInput() ?>

    <?= $form->field($model, 'denominacion_partida')->textInput() ?>

    <?= $form->field($model, 'id_clasificacion')->textInput() ?>

    <?= $form->field($model, 'descripcion_clasificacion')->textInput() ?>

    <?= $form->field($model, 'id_unidad')->textInput() ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'partida_origen')->textInput() ?>

    <?= $form->field($model, 'asignacion')->textInput() ?>

    <?= $form->field($model, 'tipo_operacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

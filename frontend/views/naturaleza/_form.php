<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Naturaleza */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="naturaleza-form">

    <?php $form = ActiveForm::begin(); ?>

    <center class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

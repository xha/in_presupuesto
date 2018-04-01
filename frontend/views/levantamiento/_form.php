<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Levantamiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="levantamiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <center class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'total')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>

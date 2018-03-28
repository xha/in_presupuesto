<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partida-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_partida') ?>

    <?= $form->field($model, 'partida') ?>

    <?= $form->field($model, 'generica') ?>

    <?= $form->field($model, 'especifica') ?>

    <?= $form->field($model, 'subEspecifica') ?>

    <?php // echo $form->field($model, 'denominacion') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'movimiento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

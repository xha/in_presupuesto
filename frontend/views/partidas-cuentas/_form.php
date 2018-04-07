<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\PartidasCuentas */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/partidas-cuentas.js');
$this->registerCssFile('@web/css/general.css');
?>

<div class="partidas-cuentas-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <center>
        <?= Html::submitButton("Actualizar",['class'=>'btn btn-success']); ?>
    </center>

    <b>Partida</b><br />
    <?= $form->field($model, 'id_partida')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $partida,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_partida();'],
        ]);
    ?>

    <?= $form->field($model, 'descripcion_partida')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'id_cuenta')->textInput() ?>

    <?= $form->field($model, 'descripcion_cuenta')->textInput() ?>

    <?= $form->field($model, 'nrolinea')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'relacion')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

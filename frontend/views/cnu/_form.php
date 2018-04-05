<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\Models\Cnu */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/cnu.js');
$this->registerCssFile('@web/css/general.css');
?>

<div class="cnu-form">

    <?php $form = ActiveForm::begin(); ?>
    <center>
        <?= Html::submitButton("Actualizar",['class'=>'btn btn-success']); ?>
    </center>
    <b>Unidad</b><br />
    <?= $form->field($model, 'id_unidad')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $unidad,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_unidad();'],
        ]);
    ?>

    <b>Clasificaci&oacute;n</b><br />
    <?= $form->field($model, 'id_clasificacion')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $clasificacion,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_clasificacion();'],
        ]);
    ?>

    <b>Partida</b><br />
    <?= $form->field($model, 'id_partida')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $partida,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_partida();'],
        ]);
    ?>

    <b>Cuenta Contable</b><br />
    <?= $form->field($model, 'cuentaC')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $cuentac,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_cuenta();'],
        ]);
    ?>
    
    <?= $form->field($model, 'CodItem')->textInput() ?>

    <?= $form->field($model, 'EsServicio')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>

    <?php ActiveForm::end(); ?>

</div>

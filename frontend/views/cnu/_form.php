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

    <b>Partida</b><br />
    <?= $form->field($model, 'id_partida')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $partida,
                'minLength'=>'6', 
            ],
            'options' => ['class' => 'form-control', 'onblur'=>'js:buscar_partida();'],
        ]);
    ?>

    <?= $form->field($model, 'id_cuenta')->dropDownList(["" => "Seleccione"]); ?>
    
    <?= $form->field($model, 'EsServicio')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <?= $form->field($model, 'CodItem')->textInput(['onblur'=>'js:buscar_item();']) ?>
    
    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

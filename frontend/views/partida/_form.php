<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Partida */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/partida.js');
$this->registerCssFile('@web/css/general.css');
?>

<div id="msj_principal"></div>
<div class="partida-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <center class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <div style="float: left; width: 100%">
        <div class="col-md-2">
            <b>Partida</b><br />
            <?= $form->field($model, 'partida')->textInput(['class'=>'texto texto-xc','maxlength' => 3,'onblur'=>'js:compuesta();', 'readonly' => !$model->isNewRecord])->label(false) ?>
        </div>

        <div class="col-md-2">
            <b>Gen&eacute;rica</b><br />
            <?= $form->field($model, 'generica')->textInput(['class'=>'texto texto-xc','maxlength' => 2,'onblur'=>'js:compuesta();', 'readonly' => !$model->isNewRecord])->label(false) ?>
        </div>

        <div class="col-md-2">
            <b>Espec&iacute;fica</b><br />
            <?= $form->field($model, 'especifica')->textInput(['class'=>'texto texto-xc','maxlength' => 2,'onblur'=>'js:compuesta();', 'readonly' => !$model->isNewRecord])->label(false) ?>
        </div>

        <div class="col-md-2">
            <b>Sub Espec&iacute;fica</b><br />
            <?= $form->field($model, 'subEspecifica')->textInput(['class'=>'texto texto-xc','maxlength' => 2,'onblur'=>'js:compuesta();', 'readonly' => !$model->isNewRecord])->label(false) ?>
        </div>
        
        <div class="col-md-2">
            <b>Compuesta</b><br />
            <?= $form->field($model, 'id_partida')->textInput(['class'=>'texto texto-ec', 'readonly' => true])->label(false) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'denominacion')->textArea(['maxlength' => 500, 'rows' => 1]) ?>

    <?= $form->field($model, 'descripcion')->textArea(['maxlength' => 4000, 'rows' => 5]) ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

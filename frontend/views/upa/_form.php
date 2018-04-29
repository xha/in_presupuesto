<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;

$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/upa.js'); //col-md-2
$this->registerCssFile('@web/css/general.css');

$id_usuario = Yii::$app->user->identity->id_usuario;
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);
if (isset($_GET['tipo_operacion'])==1) {
    $tipo = $_GET['tipo_operacion'];
} else {
    $tipo = 'M';
}

$asignacion="";
if (isset($_GET['asignacion'])==1) $asignacion = $_GET['asignacion'];
//,'onclick'=>'js:agregar_fila();', 'id'=> 'btn_enviar'
?>

<div class="upa-form">
    <?php $form = ActiveForm::begin(); ?>
    <center class="form-group">
        <?php //Html::submitButton($model->isNewRecord ? 'Crear '.$titulo : 'Actualizar'.$titulo, ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::submitButton("Actualizar ",['class'=>'btn btn-success']); ?> 
        <img id='load' src='../../../img/preloader.gif' />
    </center>
    <input type="hidden" id='id_upa' name='id_upa' value="<?= $model->id_upa; ?>" />
    <table class="inicial11">
        <tr>
            <td>
                <b>Asignaci&oacute;n</b><br />
                <?= $form->field($model, 'asignacion')->textInput(['class' => 'texto texto-ec', 'value'=>$asignacion])->label(false); ?>
            </td>
            <td>
                <b>Clasificaci&oacute;n</b><br />
                <?= $form->field($model, 'id_clasificacion')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $clasificacion,
                            'minLength'=>'6', 
                        ],
                        'options' => ['class'=>'texto texto-ec','onblur'=>'js:buscar_clasificacion();','maxlength' => 10],
                    ]);
                ?>
            </td>
            <td>
                <b>Descripci&oacute;n</b><br />
                <?= $form->field($model, 'descripcion_clasificacion')->textInput(['readonly' => true,'class'=>'texto texto-el'])->label(false); ?>
            </td>
        </tr>
        <tr>
            <td width="250">
                <br /><b>Fecha</b><br />
                <?= $form->field($model, 'fecha')->label(false)->widget(DatePicker::classname(), [
                        'language' => 'es',
                        'removeButton'=>false,
                        'options' => ['class'=>'texto texto-ec','readonly' => true, 'value' => $fecha],
                        'pluginOptions' => [
                            'endDate' => date('d-m-Y'),
                            'autoclose'=>true,
                            'format' => 'dd-mm-yyyy',
                        ]
                    ]);
                ?>
            </td>
            <td>
                <b>Partida</b><br />
                <?= $form->field($model, 'id_partida')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $partida,
                            'minLength'=>'6', 
                        ],
                        'options' => ['class'=>'texto texto-ec','onblur'=>'js:buscar_partida();','maxlength' => 10],
                    ]);
                ?>
            </td>
            <td>
                <b>Denominaci&oacute;n</b><br />
                <?= $form->field($model, 'denominacion_partida')->textInput(['readonly' => true,'class'=>'texto texto-el'])->label(false); ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Monto</b><br />
                <?= $form->field($model, 'signo')->dropDownList(['1' => '+', '0' => '-'],['class' => 'texto texto-xc'])->label(false); ?>
                <?= $form->field($model, 'monto')->textInput(['class' => 'texto texto-ec'])->label(false); ?>
            </td>
            <td>
                <b>Unidad</b><br />
                <?= $form->field($model, 'id_unidad')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $unidad,
                            'minLength'=>'6', 
                        ],
                        'options' => ['class'=>'texto texto-ec','onblur'=>'js:buscar_unidad();','maxlength' => 10],
                    ]);
                ?>
            </td>
            <td>
                <b>Ubicaci&oacute;n</b><br />
                <input id="ubic" name="ubic" readonly="true" class="texto texto-el" /> 
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <b>Observaci&oacute;n</b><br />
                <?= $form->field($model, 'observacion')->textInput(['class'=>'texto texto-xl'])->label(false); ?>
            </td>
        </tr>
    </table>
    
    <table class="tablas inicial11" style="margin-top: 10px" id="listado_detalle"></table>
    
    <?= $form->field($model, 'tipo_operacion')->hiddenInput(['value'=>$tipo])->label(false); ?>
    <?= $form->field($model, 'verificado')->hiddenInput()->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>

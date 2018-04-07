<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/solicitud.js'); //col-md-2
$this->registerCssFile('@web/css/general.css');

$id_usuario = Yii::$app->user->identity->id_usuario;
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);
?>

<div class="transaccion-form">

    <center class="form-group">
        <?= Html::submitButton("Actualizar Solicitud",['class'=>'btn btn-success','onclick'=>'js:validar_data();', 'id'=> 'btn_enviar']); ?>
        <img id='load' src='../../../img/preloader.gif' />
    </center>
    
    <?php $form = ActiveForm::begin(); ?>

    <table class="inicial11">
        <tr>
            <td>
                <b>Asignaci&oacute;n</b><br />
                <?= $form->field($model, 'asignacion')->dropDownList($asignacion,['prompt'=>'Seleccione','class'=>'texto texto-ec','onchange'=>'js:buscar_clasificacion();'])->label(false); ?> 
            </td>
            <td>
                <b>Fecha</b><br />
                <div style="width: 150px">
                    <?= $form->field($model, 'fecha')->label(false)->widget(DatePicker::classname(), [
                            'language' => 'es',
                            'removeButton'=>false,
                            'options' => ['readonly' => true, 'value' => $fecha],
                            'pluginOptions' => [
                                'endDate' => date('d-m-Y'),
                                'autoclose'=>true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                    ?>
                </div>
            </td>
            <td>
                <b>Descuento</b><br />
                <?= $form->field($model, 'descuento')->textInput(['readonly' => true, 'class'=>'texto texto-corto'])->label(false) ?>
            </td>
            <td>
                <b>Total</b><br />
                <?= $form->field($model, 'total')->textInput(['readonly' => true, 'class'=>'texto texto-corto'])->label(false) ?>
            </td>
        </tr>
    </table>
    
    
    <?= $form->field($model, 'id_transaccionO')->hiddenInput(['value' => 0])->label(false) ?>
    <?= $form->field($model, 'nro_factura')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'nro_control')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'nro_orden')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'id_usuario')->hiddenInput(['value' => $id_usuario])->label(false); ?>
    <?= $form->field($model, 'activo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'tipo')->hiddenInput(['value' => 'C'])->label(false); ?>
    
    <?= $form->field($model, 'CodProv')->textInput(['class'=>'col-md-1 texto']) ?>
    <?= $form->field($model, 'DescripProv')->textInput(['class'=>'col-md-6 texto']) ?>
    <br /><br />
    <?= $form->field($model, 'id_autorizado')->textInput(['class'=>'col-md-1 texto']) ?>
    <?= $form->field($model, 'nombre_autorizado')->textInput(['class'=>'col-md-6 texto']) ?>
    <br /><br />
    <?= $form->field($model, 'concepto')->textArea(['rows'=>2, 'maxlength'=>2000]) ?>

    <div style="border-top: 1px solid red; overflow-x: scroll; padding: 3px">
        <table class="inicial11">
            <tr>
                <td>
                    <b>Clasificaci&oacute;n *</b><br />
                    <select id="d_clasificacion" name="d_clasificacion" class='texto texto-medio' onchange="buscar_partida()">
                        <option value="">Seleccione</option>
                    </select>
                </td> 
                <td>
                    <b>Partida *</b><br />
                    <select id="d_partida" name="d_partida" class='texto texto-corto'>
                        <option value="">Seleccione</option>
                    </select>
                </td> 
                <td>
                    <b>Item *</b><br />
                    <input id="d_item" name="d_item" class="texto texto-corto" />
                    <!--<select id="d_item" name="d_item" class='texto texto-corto'>
                        <option value="">Seleccione</option>
                    </select>-->
                </td> 
                <td>
                    <b>Descripción</b><br />
                    <input id="d_item_descripcion" name="d_item_descripcion" class="texto texto-medio" />
                </td>
                <td>
                    <button type="button" class="btn btn-primary" id="d_agregar" onclick="valida_detalle()"><br />Agregar<br /><br /></button>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Fila</b><br />
                    <input id="d_fila" maxlength="5" class="texto texto-xc" readonly="true" />
                </td>
                <td>
                    <b>Cantidad *</b><br />
                    <input id="d_cantidad" maxlength="10" class="texto texto-ec" 
                     onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" onblur='calcula_total()' />
                </td>
                <td>
                    <b>Precio *</b><br />
                    <input id="d_precio" maxlength="20" class="texto texto-ec" 
                     onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" onblur='calcula_total()' />
                </td>
                <td>
                    <b>Total Item</b><br />
                    <input id="d_total" readonly maxlength="20" class="texto texto-corto" />
                </td>
                <td valign='bottom' align="left">
                    <button type="button" class="btn btn-default" onclick="limpiar_detalle()">Limpiar</button>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <b>Observaciones:</b><br />
                    <input id="d_observacion" maxlength="500" class="form-control" />
                </td>
            </tr>
        </table>
        <br />
        <table class="tablas inicial11" style="margin-top: 10px" id="listado_detalle"></table>
    </div>
    <?php ActiveForm::end(); ?>

</div>

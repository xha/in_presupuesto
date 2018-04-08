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
    <?= $form->field($model, 'id_clasificacion')->dropDownList(['' => 'Seleccione'],['class'=>'col-md-6 texto','onchange'=>'js:buscar_partida();']); ?>
    <?= $form->field($model, 'id_partida')->dropDownList(['' => 'Seleccione'],['class'=>'col-md-2 texto']); ?>
    <br /><br />
    <?= $form->field($model, 'concepto')->textArea(['rows'=>2, 'maxlength'=>2000]) ?>
    <?php 
        Modal::begin([
            "id" => "m_servicio",
            "header" => "<h3>Listado de Items</h3>",
            "size" => "modal-lg",
            "toggleButton" => ["label" => "Agregar Producto / Servicio", 'class' => 'btn btn-primary', 'id' => 'b_servicio'],
        ]);

       echo "<select id='m_esprod' class='texto texto medio'>
                <option value='0'>Productos</option>
                <option value='1'>Servicios</option>
           </select>
            <input class='texto texto medio' id='m_producto' onkeypress='return presiona(event,buscar_items);' />
            <label class='btn btn-primary' onclick='buscar_items()'>Buscar</label>
            <img id='img_producto' style='visibility: hidden' src='../../../img/preloader.gif' />
            <div style='max-height: 600px; overflow: scroll; width: 100%' >
                <h4 style='color: red' id='h_bloqueo'></h4>
                <table id='resultado_producto' class='tablas inicial00' style='width: 98%'></table>
            </div>";

        Modal::end();
    ?>
    <div class="inicial00">
        <table class="inicial00">
            <tr>
                <td>
                    Fila<br />
                    <input id="d_fila" maxlength="5" class="texto texto-xc" readonly="true" />
                </td>
                <td>
                    Descripci&oacute;n *<br />
                    <input id="d_nombre" maxlength="120" class="texto texto-largo" />
                </td> 
                <td>
                    Cantidad *<br />
                    <input id="d_cantidad" maxlength="10" class="texto texto-ec" 
                     onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" />
                </td>
                <td>
                    Precio *<br />
                    <input id="d_precio" maxlength="20" class="texto texto-ec" 
                     onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" />
                </td>
                <td>
                    Exento<br />
                    <input id="es_exento" class="texto texto-xc" readonly="true" />
                </td>
                <td>
                    Total Item<br />
                    <input id="d_total" readonly maxlength="20" class="texto texto-ec" />
                </td>
                <td>
                    <button type="button" class="btn btn-primary" id="d_agregar" onclick="valida_detalle()">Actualizar</button>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Observaciones:<br />
                    <input id="d_observacion" maxlength="500" class="texto texto-xl" />
                </td>
                <td valign='bottom' align="left">
                    <button type="button" class="btn btn-default" onclick="limpiar_detalle()">Limpiar</button>
                </td>
            </tr>
        </table>
    </div>
    <table class="tablas inicial_em2" style="margin-top: 10px" id="listado_detalle"></table>
    <?php ActiveForm::end(); ?>

</div>

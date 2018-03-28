<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\Tabs;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
use kartik\tabs\TabsX;
use frontend\models\Vendedor;
use frontend\models\Ubicacion;
use frontend\models\Impuesto;

$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/compra.js');
$this->registerCssFile('@web/css/general.css');
//$id_usuario = Yii::$app->user->identity->id_usuario;
$id_usuario = 1;
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);

$contenido1='<table class="inicial_em2">
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
        </table>
        <table class="tablas inicial_em2" style="margin-top: 10px" id="listado_detalle"></table>';

$contenido2 = '<table class="tablas inicial_em2">
            <tr>
                <td align="right">Nota 1</td>
                <td><input id="compra-notas1" name="Venta[Notas1]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 2</td>
                <td><input id="compra-notas2" name="Venta[Notas2]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 3</td>
                <td><input id="compra-notas3" name="Venta[Notas3]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 4</td>
                <td><input id="compra-notas4" name="Venta[Notas4]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 5</td>
                <td><input id="compra-notas5" name="Venta[Notas5]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 6</td>
                <td><input id="compra-notas6" name="Venta[Notas6]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 7</td>
                <td><input id="compra-notas7" name="Venta[Notas7]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 8</td>
                <td><input id="compra-notas8" name="Venta[Notas8]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
            <tr>
                <td align="right">Nota 9</td>
                <td><input id="compra-notas9" name="Venta[Notas9]" maxlength="60" class="texto texto-el" /></td>
            </tr> 
        </table>';
?>

<div id="msj_principal"><?= $msg ?></div>
<div class="compra-form">
    <center>
        <?= Html::submitButton("Actualizar ".$titulo,array('class'=>'btn btn-success','onclick'=>'js:enviar_data();', 'id'=> 'btn_enviar')); ?>
        <img id='img_load' style='visibility: hidden' src='../../../img/preloader.gif' />
    </center>

    <?php $form = ActiveForm::begin(); ?>
    <?php //Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <input type="hidden" id='i_items' name='i_items' />
    <input type="hidden" id='nro_unico' name='nro_unico' value="<?= $model->NroUnico; ?>" />
    <?= $form->field($model, "id_usuario")->hiddenInput(['value'=> 1])->label(false); ?>
    <div class="inicial_em1">
        <table class="tabla-decorada" height="202">
            <tr>
                <td align="right"><b>Proveedor</b></td>
                <td valign="top">
                    <?= $form->field($model, 'CodProv')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                            'clientOptions' => [
                                'source' => $data,
                                'minLength'=>'4', 
                            ],
                            'options' => ['class' => 'texto texto-ec','onblur'=>'js: buscar_proveedor()', 'readonly' => !$model->isNewRecord],

                        ]) 
                    ?>
                </td>
                <td>
                    <?= $form->field($model, 'Descrip')->TextInput(['class' => 'texto texto-largo', 'readonly' => true])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Ubicación</b></td>
                <td>
                    <?= Html::activeDropDownList($model, 'CodUbic',
                      ArrayHelper::map(Ubicacion::find()->where(['Activo' => '1'])->OrderBy('Descrip')->all(), 'CodUbic', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>
                </td>
                <td align="right" rowspan="3">
                    <br /><br /><br /><br /><br />
                    <img src="../../../img/saint.jpg" width="167" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>IVA</b></td>
                <td>
                    <?= Html::activeDropDownList($model, 'Notas10',
                      ArrayHelper::map(Impuesto::find()->where(['Activo' => '1'])->OrderBy('MtoTax Desc')->all(), 'CodTaxs', 'MtoTax', 'Descrip'), ['class'=>'form-control']) ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Fecha *</b></td>
                <td>
                    <?= $form->field($model, 'FechaE')->label(false)->widget(DatePicker::classname(), [
                            'language' => 'es',
                            'removeButton'=>false,
                            'options' => ['class' => 'texto texto-ec', 'readonly' => true, 'value' => $fecha],
                            'pluginOptions' => [
                                'endDate' => date('d-m-Y'),
                                'autoclose'=>true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                    ?>
                </td>
            </tr>
        </table>
        <table class="tabla-decorada" style="width:25em">
            <tr>
                <td align="right"><b>Documento</b></td>
                <td><?= $form->field($model, 'NumeroD')->TextInput(['class' => 'texto texto-corto', 'readonly' => true])->label(false); ?></td>
            </tr>
            <tr>
                <td align="right"><b>Descuento</b></td>
                <td><?= $form->field($model, 'DesctoP')->TextInput(['class'=>'texto texto-corto', 'readonly' => true])->label(false); ?></td>
            </tr>
            <tr>
                <td align="right"><b>Sub Total</b></td>
                <td><?= $form->field($model, 'Monto')->TextInput(['class'=>'texto texto-corto', 'readonly' => true])->label(false); ?></td>
            </tr>
            <tr>
                <td align="right"><b>Impuestos</b></td>
                <td><?= $form->field($model, 'MtoTax')->TextInput(['class'=>'texto texto-corto', 'readonly' => true])->label(false); ?></td>
            </tr>
            <tr>
                <td align="right" height="57"><b>Total</b></td>
                <td><?= $form->field($model, 'MtoTotal')->TextInput(['class'=>'texto texto-corto', 'readonly' => true])->label(false); ?></td>
            </tr>
        </table>
    </div>
    <table>
        <tr>
            <td>
                <?= $form->field($model, 'Direc1')->TextInput(['readonly' => true, 'class'=> 'texto texto-xl']); ?><br /><br />
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
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    echo TabsX::widget([
                        'position' => TabsX::POS_ABOVE,
                        'align' => TabsX::ALIGN_LEFT,
                        'items' => [
                            [
                                'label' => 'Items',
                                'content' => $contenido1,
                                'active' => true
                            ],
                            [
                                'label' => 'Comentarios',
                                'content' => $contenido2,
                                'headerOptions' => ['style'=>'font-weight:bold'],
                                'options' => ['id' => 'myveryownID'],
                            ],
                        ],
                    ]);
                ?>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'TipoCom')->hiddenInput(['value'=>$TipoCom])->label(false); ?>
    <?= $form->field($model, 'CodSucu')->hiddenInput(['value'=>'00000'])->label(false); ?>
    <?= $form->field($model, 'TotalPrd')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'ID3')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'Direc2')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'Telef')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'TotalSrv')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'CostoPrd')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'CostoSrv')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TGravable')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TExento')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'CodUsua')->hiddenInput(['value'=>$id_usuario])->label(false); ?>
    <?= $form->field($model, 'Signo')->hiddenInput(['value'=>'1'])->label(false); ?>
    <?= $form->field($model, 'EsExPickup')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Factor')->hiddenInput(['value'=>'1'])->label(false); ?>
    <?= $form->field($model, 'MontoMEx')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Fletes')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'RetenIVA')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Credito')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Contado')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'EsCorrel')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Municipio')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TipoTraE')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TGravable0')->hiddenInput(['value'=>'0'])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\UnidadMedida;
use frontend\models\Naturaleza;
/* @var $this yii\web\View */
/* @var $model frontend\models\Levantamiento */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/levantamiento.js');
$this->registerCssFile('@web/css/general.css');
$mes = Array('1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
?>

<div class="levantamiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <center class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success']) ?>
    </center>

    <?= $form->field($model, 'total')->textInput(['readonly' => true, 'class' => 'texto texto-medio']) ?>
    <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'activo')->hiddenInput(['value' => 0])->label(false); 
        } else {
            echo $form->field($model, 'activo')->dropDownList(['0' => 'NO','1' => 'SI'], ['class' => 'texto texto-ec']); 
        }
    ?>
    
    <br /><br />
    <table class="inicial_em2">
        <tr>
            <td>
                <b>Fila</b><br />
                <input id="d_fila" maxlength="5" class="texto texto-xc" readonly="true" />
            </td>
            <td>
                <b>Clasificaci&oacute;n *</b><br />
                <select id="levantamiento-id_clasificacion" name="Levantamiento[id_clasificacion]" class='texto texto-medio'>
                    <option value="">Seleccione</option>
                    <?= $clasificacion; ?>
                </select>
            </td> 
            <td>
                <b>Partida *</b><br />
                <?= $form->field($model, 'id_partida')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $partida,
                            'minLength'=>'6', 
                        ],
                        'options' => ['class' => 'texto texto-ec'],
                    ]);
                ?>
            </td> 
            <td>
                <b>Unidad de Medida *</b><br />
                <?= Html::activeDropDownList($model, 'id_unidad_medida',
                    ArrayHelper::map(UnidadMedida::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_unidad_medida', 'descripcion'), ['class'=>'texto texto-corto','prompt'=>'Seleccione']) ?>
            </td> 
            <td>
                <b>Naturaleza de Gasto *</b><br />
                <?= Html::activeDropDownList($model, 'id_naturaleza',
                    ArrayHelper::map(Naturaleza::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_naturaleza', 'descripcion'), ['class'=>'texto texto-corto','prompt'=>'Seleccione']) ?>
            </td> 
            <td>
                <b>Mes *</b><br />
                <?= $form->field($model, 'mes')->dropDownList($mes,['prompt'=>'Seleccione','class'=>'texto texto-ec'])->label(false); ?>
            </td> 
            <td rowspan="3">
                <button type="button" class="btn btn-primary" id="d_agregar" onclick="valida_detalle()"><br />Agregar<br /><br /></button>
            </td>
        </tr>
        <tr>
            <td>
                <b>Indice Inf.</b><br />
                <input id="d_indice" onkeypress="return entero(event);" class="texto texto-xc" maxlength="5" value="1" />
            </td>
            <td>
                <b>Rubro / Item *</b><br />
                <input id="d_nombre" maxlength="120" class="texto texto-medio" />
            </td> 
            <td>
                <b>Cantidad *</b><br />
                <input id="d_cantidad" maxlength="10" class="texto texto-ec" 
                 onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" />
            </td>
            <td>
                <b>Precio *</b><br />
                <input id="d_precio" maxlength="20" class="texto texto-ec" 
                 onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" />
            </td>
            <td>
                <b>Total Item</b><br />
                <input id="d_total" readonly maxlength="20" class="texto texto-corto" />
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <b>Observaciones:</b><br />
                <input id="d_observacion" maxlength="500" class="form-control" />
            </td>
        </tr>
    </table>
    <table class="tablas inicial_em2" style="margin-top: 10px" id="listado_detalle"></table>
    
    <?php ActiveForm::end(); ?>

</div>

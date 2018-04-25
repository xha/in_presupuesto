<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;

$this->registerJsFile('@web/general.js');
//$this->registerJsFile('@web/js/solicitud.js'); //col-md-2
$this->registerCssFile('@web/css/general.css');

$id_usuario = Yii::$app->user->identity->id_usuario;
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);
if (isset($_GET['tipo'])==1) {
    $tipo = $_GET['tipo'];
} else {
    $tipo = 'M';
}
if (isset($_GET['titulo'])==1) {
    $titulo = $_GET['titulo'];
} else {
    $titulo = 'Modificación';
}
?>

<div class="upa-form">

    <center class="form-group">
        <?= Html::submitButton("Actualizar ".$titulo,['class'=>'btn btn-success','onclick'=>'js:validar_data();', 'id'=> 'btn_enviar']); ?>
        <img id='load' src='../../../img/preloader.gif' />
    </center>
    
    <?php $form = ActiveForm::begin(); ?>
    
    <table class="inicial22">
        <tr>
            <td>
                <b>Asignaci&oacute;n</b><br />
                <?= $form->field($model, 'asignacion')->textInput(['class' => 'texto texto-ec'])->label(false); ?>
            </td>
            <td>
                <b>Monto Global</b><br />
                <?= $form->field($model, 'monto')->textInput(['class' => 'texto texto-medio', 'readonly' => true])->label(false) ?>
            </td>
            <td width="150">
                <b>Fecha</b><br />
                <?= $form->field($model, 'fecha')->label(false)->widget(DatePicker::classname(), [
                        'language' => 'es',
                        'removeButton'=>false,
                        'options' => ['readonly' => true, 'value' => $fecha, 'class' => 'texto texto-ec'],
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
    
    <?= $form->field($model, 'id_clasificacion')->dropDownList(['' => 'Seleccione', $clasificacion],['class'=>'col-md-6 texto','onchange'=>'js:alert(this.value);']); ?>
    
    <?= $form->field($model, 'id_partida')->dropDownList(['' => 'Seleccione'],['class'=>'col-md-2 texto']); ?>

    <?= $form->field($model, 'denominacion_partida')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'descripcion_clasificacion')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'partida_origen')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'tipo_operacion')->hiddenInput(['value'=>$tipo])->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>

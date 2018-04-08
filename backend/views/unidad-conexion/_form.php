<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Unidad;
/* @var $this yii\web\View */
/* @var $model backend\models\UnidadConexion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidad-conexion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base_datos')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'clave')->textInput(['type' => 'password', 'maxlength' => 255]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'puerto')->textInput() ?>

    <?= $form->field($model, 'id_unidad')->dropDownList(ArrayHelper::map(Unidad::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_unidad', 'id_unidad', 'descripcion')); ?>
    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <label class='btn btn-default' onclick="probar()">Probar Conexión</label>
        <img id='img_load' style='visibility: hidden' src='../../../img/preloader.gif' />
    </div>
    <h3 style="color: red" id='probar_conexion'></h3>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function probar() {
        var bd = document.getElementById('unidadconexion-base_datos').value;
        var ip = document.getElementById('unidadconexion-ip').value;
        var clave = document.getElementById('unidadconexion-clave').value;
        var puerto = document.getElementById('unidadconexion-puerto');
        var usuario = document.getElementById('unidadconexion-usuario').value;
        var probar_conexion = document.getElementById('probar_conexion');
        var img_load = document.getElementById('img_load');

        probar_conexion.innerHTML = "";
        if ((bd!="") && (ip!="") && (clave!="") && (usuario!="")) {
            img_load.style.visibility = "visible";
            if (puerto.value=="") puerto.value="1433";
            $.get('../unidad-conexion/buscar-conexion',{bd : bd, ip : ip, clave : clave, usuario : usuario, puerto : puerto.value},function(data){
                probar_conexion.innerHTML = data;
                img_load.style.visibility = "hidden";
            });
        }
    }
</script>
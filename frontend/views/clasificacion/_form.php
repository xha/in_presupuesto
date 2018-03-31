<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/clasificacion.js');
$this->registerCssFile('@web/css/general.css');
if (isset($_GET['id'])==1) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
?>
<div id="msj_principal"></div>
<div class="clasificacion-form">
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" id='id' value="<?= $id ?>" />
    <center>
        <?= Html::submitButton("Actualizar",['class'=>'btn btn-success']); ?>
    </center>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'descripcion')->textArea(['maxlength' => 250, 'rows' => 1]) ?>

    <?= $form->field($model, 'detalle')->textArea(['maxlength' => 4000, 'rows' => 5]) ?>

    <?= $form->field($model, 'nivel')->dropDownList(['1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6'], ['prompt' => 'Seleccione','onclick'=>'js:buscar_padre();']); ?>
    
    <?= $form->field($model, 'padre')->dropDownList(['prompt'=>'Seleccione']); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\Models\Unidad */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('../../../frontend/web/general.js');
$this->registerJsFile('@web/js/unidad.js');
if (isset($_GET['id'])==1) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
?>

<div class="unidad-form">

    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" id='id' value="<?= $id ?>" />
    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'responsable')->textInput() ?>

    <?= $form->field($model, 'nivel')->dropDownList(['1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6', '7' => '7', '8' => '8'], ['prompt' => 'Seleccione','onclick'=>'js:buscar_padre();']); ?>
    
    <?= $form->field($model, 'padre')->dropDownList(['prompt'=>'Seleccione']); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

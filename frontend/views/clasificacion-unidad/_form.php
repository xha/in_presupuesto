<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClasificacionUnidad */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/clasificacion_unidad.js');
$this->registerCssFile('@web/css/general.css');

?>

<div class="clasificacion-unidad-form">

    <?php $form = ActiveForm::begin(); ?>
    <label style="display: none" id='nivel_clasificacion' /><?= $nivel_clasificacion ?></label>
    <label style="display: none" id='nivel_unidad' /><?= $nivel_unidad ?></label>
    <center>
        <?= Html::submitButton("Actualizar",array('class'=>'btn btn-success')); ?>
    </center>

    <?= $form->field($model, 'nivel_clasificacion')->dropDownList([0 => 0],['prompt' => 'Seleccione','onchange'=>'js:b_clasificacion(this);']); ?>
    
    <?= $form->field($model, 'id_clasificacion')->dropDownList(['prompt'=>'Seleccione']); ?>
    
    <?= $form->field($model, 'nivel_unidad')->dropDownList([0 => 0],['prompt' => 'Seleccione','onchange'=>'js:b_unidad();']); ?>

    <?= $form->field($model, 'id_unidad')->dropDownList(['prompt'=>'Seleccione']); ?>

    <?php ActiveForm::end(); ?>

</div>

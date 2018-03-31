<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

if (isset($_GET['tipo'])==1) {
    $tipo = $_GET['tipo'];
} else {
    $tipo = 'F';
}

switch ($tipo) {
    case 'B': $titulo = 'Anteproyecto';
    break;
    case 'M': $titulo = 'Modificación';
    break;
    default: $titulo = 'Asignación';
}

$this->title = 'Actualizar '.$titulo;
$this->params['breadcrumbs'][] = ['label' => 'Formulación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

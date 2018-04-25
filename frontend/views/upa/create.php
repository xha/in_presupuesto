<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

if (isset($_GET['tipo'])==1) {
    $tipo = $_GET['tipo'];
} else {
    $tipo = 'M';
}

switch ($tipo) {
    case 'B': $titulo = 'Anteproyecto';
    break;
    case 'A': $titulo = 'Asignación';
    break;
    default: $titulo = 'Modificación';
}

$this->title = 'Actualizar '.$titulo;
$this->params['breadcrumbs'][] = ['label' => 'Formulación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-create">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
        'clasificacion' => $clasificacion,
    ]) ?>

</div>

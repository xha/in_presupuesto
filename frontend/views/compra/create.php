<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Compra */
if (isset($_GET['TipoCom'])==1) {
    $TipoCom = $_GET['TipoCom'];
} else {
    $TipoCom = 'F';
}

switch ($TipoCom) {
    case 'H': $titulo = 'Compra';
    break;
    case 'I': $titulo = 'Devoluciones de Compra';
    break;
    case 'S': $titulo = 'Cotización';
    break;
    case 'J': $titulo = 'Notas de Entrega de Compra';
    break;
    case 'K': $titulo = 'Devoluciones de Notas de Entrega de Compra';
    break;
    default: $titulo = 'Orden de C/S';
}

$this->title = 'Crear '.$titulo;
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-create">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'TipoCom' => $TipoCom,
        'titulo' => $titulo,
        'msg' => $msg
    ]) ?>

</div>

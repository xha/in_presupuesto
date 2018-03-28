<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\Models\Venta */

if (isset($_GET['TipoFac'])==1) {
    $TipoFac = $_GET['TipoFac'];
} else {
    $TipoFac = 'F';
}

switch ($TipoFac) {
    case 'A': $titulo = 'Factura';
    break;
    case 'B': $titulo = 'Devoluciones de Factura';
    break;
    case 'E': $titulo = 'Pedido';
    break;
    case 'C': $titulo = 'Notas de Entrega de Venta';
    break;
    case 'D': $titulo = 'Devoluciones de Notas de Entrega de Venta';
    break;
    default: $titulo = 'Presupuesto';
}

$this->title = 'Crear '.$titulo;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-create">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'TipoFac' => $TipoFac,
        'titulo' => $titulo,
        'msg' => $msg
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */

$this->title = $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_transaccion], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_transaccion',
            'id_transaccionO',
            'nro_control',
            'nro_factura',
            'nro_orden',
            'fecha',
            'fecha_transaccion',
            'CodProv',
            'DescripProv',
            'id_autorizado',
            'nombre_autorizado',
            'concepto',
            'total',
            'tipo',
            'descuento',
            'id_usuario',
            'activo',
        ],
    ]) ?>

</div>

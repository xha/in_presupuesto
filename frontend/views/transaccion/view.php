<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Transaccion */

$this->title = $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_transaccion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_transaccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Impuesto */

$this->title = $model->CodTaxs;
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impuesto-view">
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodTaxs], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodTaxs], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CodTaxs',
            'Descrip',
            'MtoTax',
            'Activo',
            'EsFijo',
            'EsReten',
            'CodOper',
            'EsPorct',
            'EsCosto',
            'TipoIVA',
            'EsLibroI',
            'EsPartic',
            'EsTaxVenta',
            'EsTaxCompra',
            'MontoMin',
            'MontoMax',
            'Sustraendo',
        ],
    ]) ?>

</div>

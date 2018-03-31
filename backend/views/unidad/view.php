<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\Models\Unidad */

$this->title = $model->id_unidad;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_unidad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_unidad], [
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
            'id_unidad',
            'descripcion',
            'responsable',
            'nivel',
            'padre',
            'activo:boolean',
        ],
    ]) ?>

</div>

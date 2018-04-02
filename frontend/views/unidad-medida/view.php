<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UnidadMedida */

$this->title = $model->id_unidad_medida;
$this->params['breadcrumbs'][] = ['label' => 'Unidad de Medida', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-medida-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_unidad_medida], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_unidad_medida], [
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
            'id_unidad_medida',
            'descripcion',
            'activo:boolean',
        ],
    ]) ?>

</div>

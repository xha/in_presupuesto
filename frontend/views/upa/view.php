<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Upa */

$this->title = $model->id_upa;
$this->params['breadcrumbs'][] = ['label' => 'Upas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_upa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_upa], [
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
            'id_upa',
            'id_partida',
            'denominacion_partida',
            'id_clasificacion',
            'descripcion_clasificacion',
            'id_unidad',
            'monto',
            'fecha',
            'partida_origen',
            'asignacion',
            'tipo_operacion',
        ],
    ]) ?>

</div>

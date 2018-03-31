<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Clasificacion */

$this->title = $model->id_clasificacion;
$this->params['breadcrumbs'][] = ['label' => 'Clasificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_clasificacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_clasificacion], [
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
            'id_clasificacion',
            'codigo',
            'descripcion',
            'nivel',
            'padre',
            'activo',
        ],
    ]) ?>

</div>

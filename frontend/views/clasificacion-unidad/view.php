<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClasificacionUnidad */

$this->title = $model->id_clasificacion;
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-unidad-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id_clasificacion' => $model->id_clasificacion, 'id_unidad' => $model->id_unidad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id_clasificacion' => $model->id_clasificacion, 'id_unidad' => $model->id_unidad], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Borrado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_clasificacion',
            'id_unidad',
        ],
    ]) ?>

</div>

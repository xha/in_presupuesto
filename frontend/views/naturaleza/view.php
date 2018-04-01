<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Naturaleza */

$this->title = $model->id_naturaleza;
$this->params['breadcrumbs'][] = ['label' => 'Naturaleza del Gasto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="naturaleza-view">

    <p>
        <?= Html::a('Actualziar', ['update', 'id' => $model->id_naturaleza], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_naturaleza], [
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
            'id_naturaleza',
            'descripcion',
            'activo:boolean',
        ],
    ]) ?>

</div>

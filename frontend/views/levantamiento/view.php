<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Levantamiento */

$this->title = $model->id_levantamiento;
$this->params['breadcrumbs'][] = ['label' => 'Levantamiento de Información', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="levantamiento-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_levantamiento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id_levantamiento], [
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
            'id_levantamiento',
            'id_unidad',
            'fecha',
            'total',
            'activo:boolean',
        ],
    ]) ?>

</div>

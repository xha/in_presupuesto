<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Ubicacion */

$this->title = $model->CodUbic;
$this->params['breadcrumbs'][] = ['label' => 'Ubicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodUbic], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodUbic], [
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
            'CodUbic',
            'Descrip',
            'Clase',
            'Activo',
            'Represent',
            'Direc1',
            'Direc2',
            'ZipCode',
            'Telef',
            'Printer',
        ],
    ]) ?>

</div>

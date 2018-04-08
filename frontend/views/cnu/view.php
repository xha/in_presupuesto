<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Cnu */

$this->title = $model->id_cnu;
$this->params['breadcrumbs'][] = ['label' => 'Unión', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnu-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_cnu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id_cnu], [
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
            'id_cnu',
            'id_cuenta',
            'id_partida',
            'CodItem',
            'EsServicio:boolean',
            'activo:boolean',
        ],
    ]) ?>

</div>

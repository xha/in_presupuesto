<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UnidadConexion */

$this->title = $model->id_unidad_conexion;
$this->params['breadcrumbs'][] = ['label' => 'Conexión a la Unidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-conexion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_unidad_conexion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id_unidad_conexion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Borrado de la Conexión',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_unidad_conexion',
            'base_datos',
            'usuario',
            //'clave',
            'ip',
            'puerto',
            'id_unidad',
            //'activo',
        ],
    ]) ?>

</div>

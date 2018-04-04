<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LevantamientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Levantamiento de Información';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="levantamiento-index">

    <p>
        <?= Html::a('Crear Levantamiento de Información', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'asignacion',
            'id_unidad',
            'fecha',
            'total',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

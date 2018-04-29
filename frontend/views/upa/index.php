<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\UpaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch ($tipo) {
    case 'M': $titulo = 'Modificación';
    break;
    case 'B': $titulo = 'Anteproyecto';
    break;
    default: 
        $titulo = 'Asignación';
}

$this->title = $titulo;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upa-index">

    <center>
        <?= Html::a('Actualizar '.$titulo, ['upa/create?tipo_operacion='.$tipo], ['class' => 'btn btn-success']); ?>
    </center>
    <br />
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_upa',
            //'id_partida',
            //'denominacion_partida',
            //'id_clasificacion',
            //'descripcion_clasificacion',
            'asignacion',
            [
              'attribute'=>'id_unidad',
              'value'=>'unidad.descripcion',
            ],
            //'fecha',
            //'partida_origen',
            //'tipo_operacion',
            [
                'attribute' => 'tipo_operacion',
                'value' => function($model){
                    switch($model->tipo_operacion) {
                        case 'M': $valor = 'Modificación';
                        break;
                        case 'B': $valor = 'Anteproyecto';
                        break;
                        default:
                            $valor='Asignación';
                    }
                    
                    return $valor;
                },
            ],
            [
              'attribute'=>'total',
              'format' => ['decimal',2]
            ],
            //'total',
            'verificado:boolean',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {print} {aprobar}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'Imprimir Documento'),
                                    'target' => '_blank',
                        ]);
                    },
                    'aprobar' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                    'title' => Yii::t('app', 'Aprobar Documento'),
                                    'target' => '_blank',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'print') {
                        $url = Yii::$app->urlManager->createUrl(['upa/imprime-upa?asignacion='.$model->asignacion."&tipo_operacion=".$model->tipo_operacion]);
                        return $url;
                    } else if($action === 'update') {
                        if ($model->verificado==0) {
                            $url = Yii::$app->urlManager->createUrl(['upa/create?asignacion='.$model->asignacion."&tipo_operacion=".$model->tipo_operacion]);
                            return $url;
                        }
                    } else {
                        $rol = Yii::$app->user->identity->id_rol;
                        if ($rol==3) {
                            $url = Yii::$app->urlManager->createUrl(['upa/cerrar-upa?asignacion='.$model->asignacion."&tipo_operacion=".$model->tipo_operacion]);
                            return $url;
                        }
                    }
                }
                          
            ],
        ],
    ]); ?>
</div>

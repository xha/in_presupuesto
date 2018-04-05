<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LevantamientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Levantamiento de Información';
$this->params['breadcrumbs'][] = $this->title;
$id_usuario = Yii::$app->user->identity->id_usuario;

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

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {print} {aprobar}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'Imprimir Levantamiento '.$model->id_levantamiento),
                                    'target' => '_blank',
                        ]);
                    },
                    'aprobar' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                    'title' => Yii::t('app', 'Aprobar Levantamiento '.$model->id_levantamiento),
                                    'target' => '_blank',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'print') {
                        $url = Yii::$app->urlManager->createUrl(['levantamiento/imprime-levantamiento?id='.$model->id_levantamiento]);
                        return $url;
                    } else if($action === 'update') {
                        if ($model->activo==0) {
                            $url = Yii::$app->urlManager->createUrl(['levantamiento/update?id='.$model->id_levantamiento]);
                            return $url;
                        }
                    } else {
                        $rol = Yii::$app->user->identity->id_rol;
                        if ($rol==3) {
                            $url = Yii::$app->urlManager->createUrl(['levantamiento/cerrar-levantamiento?id='.$model->id_levantamiento]);
                            return $url;
                        }
                    }
                }
                          
            ],
        ],
    ]); ?>
</div>

<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Levantamiento;
use frontend\models\LevantamientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LevantamientoController implements the CRUD actions for Levantamiento model.
 */
class LevantamientoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Levantamiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LevantamientoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Levantamiento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Levantamiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Levantamiento();
        $connection = \Yii::$app->db;
        $partida = array();
        $clasificacion="";
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida FROM ISPR_Partida where activo=1 and partida like '4%' and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida'];
        }
        
        /********************** CLASIFICACION ***************************************/
        $query = "SELECT c.id_clasificacion,c.descripcion 
                FROM ISPR_Clasificacion c, ISPR_ClasificacionUnidad u 
                where c.activo=1 and c.id_clasificacion=u.id_clasificacion
                order by c.id_clasificacion";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $clasificacion.= "<option value='".$data1[$i]['id_clasificacion']."'>".$data1[$i]['id_clasificacion']." - ".$data1[$i]['descripcion']."</option>";;
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_levantamiento]);
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $partida,
            'clasificacion' => $clasificacion,
        ]);
    }

    /**
     * Updates an existing Levantamiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_levantamiento]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Levantamiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Levantamiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Levantamiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Levantamiento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

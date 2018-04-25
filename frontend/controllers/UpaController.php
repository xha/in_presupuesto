<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Upa;
use frontend\Models\UpaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UpaController implements the CRUD actions for Upa model.
 */
class UpaController extends Controller
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
     * Lists all Upa models.
     * @return mixed
     */
    public function actionIndex($tipo = NULL)
    {
        if (isset($tipo)<>1) $tipo = 'A';
        $searchModel = new UpaSearch([ 'tipo_operacion' => $tipo]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
        ]);
    }

    /**
     * Displays a single Upa model.
     * @param string $id
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
     * Creates a new Upa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBuscaClasificacion() {
        $connection = \Yii::$app->db;
        $clasificacion = array();
        /********************** CLASIFICACION ***************************************/
        $query = "SELECT c.id_clasificacion,c.descripcion 
                FROM ISPR_Clasificacion c, ISPR_ClasificacionUnidad u 
                where c.activo=1 and c.id_clasificacion=u.id_clasificacion
                order by c.id_clasificacion";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $clasificacion[]= $data1[$i]['id_clasificacion']." - ".$data1[$i]['descripcion'];
        }
    }
    
    public function actionBuscaPartida() {
        $connection = \Yii::$app->db;
        $partida = array();
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida FROM ISPR_Partida where activo=1 and partida like '4%' and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida'];
        }
        
        return $partida;
    }
    
    public function actionCreate()
    {
        $model = new Upa();
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_upa]);
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $partida,
            'clasificacion' => $clasificacion,
        ]);
    }

    /**
     * Updates an existing Upa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_upa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Upa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Upa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Upa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Upa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

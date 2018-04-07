<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Cnu;
use frontend\Models\CnuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * CnuController implements the CRUD actions for Cnu model.
 */
class CnuController extends Controller
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
     * Lists all Cnu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CnuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Cnu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cnu();
        $connection = \Yii::$app->db;
        $partida = array();
        $clasificacion = array();
        $unidad = array();
        
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida,denominacion FROM ISPR_Partida where activo=1 and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida']." - ".$data1[$i]['denominacion'];
        }
        /********************** CLASIFICACION **********************************/
        $query = "SELECT id_clasificacion,descripcion FROM ISPR_Clasificacion where activo=1 order by descripcion desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $clasificacion[]= $data1[$i]['id_clasificacion']." - ".$data1[$i]['descripcion'];
        }
        /********************** UNIDAD *****************************************/
        $query = "SELECT id_unidad,descripcion FROM ISPR_Unidad where activo=1 order by descripcion desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $unidad[]= $data1[$i]['id_unidad']." - ".$data1[$i]['descripcion'];
        }
        /********************** CUENTA CONTABLE ********************************/
        $query = "SELECT cuentaC,descripCC FROM ISPR_Partidas_CtasC where estatus=1 group by cuentaC,descripCC order by descripCC desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $cuentac[]= $data1[$i]['cuentaC']." - ".$data1[$i]['descripCC'];
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $partida,
            'clasificacion' => $clasificacion,
            'unidad' => $unidad,
            'cuentac' => $cuentac,
        ]);
    }

    /**
     * Deletes an existing Cnu model.
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
     * Finds the Cnu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cnu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cnu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**************** BUSQUEDAS ***********************************************************/ 
    public function actionBuscarPartida($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Partida
                WHERE id_partida='".$id."' and movimiento=1 and activo=1";
        $pendientes = $connection->createCommand($query)->queryOne();
        return $pendientes['conteo'];
    }
    
    public function actionBuscarClasificacion($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Clasificacion
                WHERE id_clasificacion=".$id." and activo=1";
        $pendientes = $connection->createCommand($query)->queryOne();
        return $pendientes['conteo'];
    }
    
    public function actionBuscarUnidad($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Unidad
                WHERE id_unidad=".$id." and activo=1";
        $pendientes = $connection->createCommand($query)->queryOne();
        return $pendientes['conteo'];
    }
    
    public function actionBuscarCuenta($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Partidas_CtasC
                WHERE id_cuenta='".$id."'";
        $pendientes = $connection->createCommand($query)->queryOne();
        return $pendientes['conteo'];
    }
}

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
        
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida,denominacion FROM ISPR_Partida where activo=1 and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida']." - ".$data1[$i]['denominacion'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $partida = explode(" - ",$model->id_partida);
            $model->id_partida = $partida[0];
            $query = "SELECT id_cnu FROM ISPR_CNU where id_partida='".$model->id_partida."' and id_cuenta='".$model->id_cuenta."' and CodItem='".$model->coditem."'";
            $data = $connection->createCommand($query)->queryOne();
            
            $id=0;
            if ($data['id_cnu']!="") {
                $query = "UPDATE ISPR_CNU SET activo=".$model->activo.",EsServicio=".$model->esservicio." where id_cnu=".$data['id_cnu'];
                $connection->createCommand($query)->execute();
                $id=$data['id_cnu'];
            } else {
                $model->save();
                $id=$model->id_cnu;
            }
            
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $partida,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;
        $partida = array();
        
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida,denominacion FROM ISPR_Partida where activo=1 and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida']." - ".$data1[$i]['denominacion'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $partida = explode(" - ",$model->id_partida);
            $model->id_partida = $partida[0];
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_cnu]);
        }

        return $this->render('update', [
            'model' => $model,
            'partida' => $partida,
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
    /**************** JSON ***********************************************************/ 
    public function actionBuscarPartida($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Partidas_CtasC
                WHERE id_partida='".$id."' and activo=1";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarItem($id) {
        $connection = \Yii::$app->db;
        
        $query = "SELECT count(*) as conteo FROM SAPROD
                WHERE CodProd='".$id."' and Activo=1";
        $producto = $connection->createCommand($query)->queryOne();
        
        $pendiente = "";
        if ($producto['conteo']>0) {
            $pendiente = 1;
        } else {
            $query = "SELECT count(*) as conteo FROM SASERV
                WHERE CodServ='".$id."' and Activo=1";
            $servicio = $connection->createCommand($query)->queryOne();
            
            if ($servicio['conteo']>0) $pendiente = 2;
        }
        
        return $pendiente;
    }
}

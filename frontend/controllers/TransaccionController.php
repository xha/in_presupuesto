<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Transaccion;
use frontend\Models\TransaccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * TransaccionController implements the CRUD actions for Transaccion model.
 */
class TransaccionController extends Controller
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
     * Lists all Transaccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaccion model.
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
     * Creates a new Transaccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaccion();
        $connection = \Yii::$app->db;
        /********************** PARTIDAS ***************************************/
        $query = "SELECT asignacion from ISPR_Upa WHERE tipo_operacion='A' group by asignacion order by asignacion";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $asignacion[$data1[$i]['asignacion']]= $data1[$i]['asignacion'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            //return $this->redirect(['view', 'id' => $model->id_transaccion]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'asignacion' => $asignacion,
        ]);
    }

    /**
     * Updates an existing Transaccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_transaccion]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transaccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**************** JSON ***********************************************************/ 
    public function actionBuscarClasificacion($asignacion) {
        $id_unidad = Yii::$app->user->identity->id_unidad;
        $connection = \Yii::$app->db;

        $query = "SELECT id_clasificacion,descripcion_clasificacion 
                FROM ISPR_Upa
                WHERE asignacion=".$asignacion." and verificado=1 and tipo_operacion IN ('A','M')
                and id_unidad=".$id_unidad."
                GROUP BY id_clasificacion,descripcion_clasificacion
                ORDER BY id_clasificacion,descripcion_clasificacion asc";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarPartida($asignacion,$clasificacion) {
        $id_unidad = Yii::$app->user->identity->id_unidad;
        $connection = \Yii::$app->db;

        $query = "SELECT id_partida
                FROM ISPR_Upa
                WHERE asignacion=".$asignacion." and verificado=1 and tipo_operacion IN ('A','M')
                and id_unidad=".$id_unidad." and id_clasificacion=".$clasificacion."
                GROUP BY id_partida
                ORDER BY id_partida asc";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarProducto($codigo, $servicio) {
        $connection = \Yii::$app->db;

        if ($servicio==1) {
            $query = "SELECT CodServ as Codigo, CONCAT(Descrip,Descrip2,Descrip3) as Descrip, Precio1 as Costo,EsExento,1 as EsServ
                    from SASERV
                    where Activo=1 and (CodServ like '%".$codigo."%' OR Descrip like '%".$codigo."%' OR Descrip2 like '%".$codigo."%' 
                    OR Descrip3 like '%".$codigo."%')";
        } else {
            $query = "SELECT CodProd as Codigo, CONCAT(Descrip,Descrip2,Descrip3) as Descrip, Precio1 as Costo,EsExento,0 as EsServ
                    from SAPROD
                    where Activo=1 and (CodProd like '%".$codigo."%' OR Descrip like '%".$codigo."%' OR Descrip2 like '%".$codigo."%' 
                    OR Descrip3 like '%".$codigo."%')";
        }
        
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    } 
}

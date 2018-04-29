<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Upa;
use frontend\Models\UpaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
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
        $query = "SELECT * FROM ISPR_Clasificacion where activo=1 order by id_clasificacion,nivel";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $clasificacion[]= $data1[$i]['id_clasificacion']." - ".$data1[$i]['codigo']." - ".$data1[$i]['descripcion'];
        }
        
        return $clasificacion;
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
    
    public function actionBuscaUnidad() {
        $connection = \Yii::$app->db;
        $partida = array();
        /********************** UNIDADES ***************************************/
        $query = "SELECT * FROM ISPR_Unidad where activo=1 order by id_unidad,nivel,padre desc";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $unidad[]= $data1[$i]['id_unidad']." - ".$data1[$i]['descripcion'];
        }
        
        return $unidad;
    }
    
    public function actionCreate()
    {
        $model = new Upa();
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            $model->verificado="0";
            if ($model->observacion=='') $model->observacion=' ';
            $query = "SELECT count(*) as conteo FROM ISPR_UPA 
                    WHERE asignacion=".$model->asignacion." and tipo_operacion='".$model->tipo_operacion."'";
            $conteo = $connection->createCommand($query)->queryOne();
            
            if ($conteo['conteo'] > 0) {
                $query = "SELECT count(*) as conteo FROM ISPR_UPA 
                    WHERE asignacion=".$model->asignacion." and tipo_operacion='".$model->tipo_operacion."' and verificado=1";
                $conteo2 = $connection->createCommand($query)->queryOne();
            
                if ($conteo2['conteo']>0) {
                    $searchModel = new UpaSearch([ 'tipo_operacion' => $model->tipo_operacion]);
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'tipo' => $model->tipo_operacion,
                    ]);
                } else {
                    $query = "SELECT *
                            FROM ISPR_UPA 
                            WHERE asignacion=".$model->asignacion." and id_unidad=".$model->id_unidad." and id_partida='".$model->id_partida."'
                            and id_clasificacion=".$model->id_clasificacion." and tipo_operacion='".$model->tipo_operacion."' and verificado=".$model->verificado;
                    $upa = $connection->createCommand($query)->queryAll();

                    if (count($upa)>0) {
                        $query = "UPDATE ISPR_UPA SET Monto=".$model->monto.",signo=".$model->signo."
                            WHERE asignacion=".$model->asignacion." and id_unidad=".$model->id_unidad." and id_partida='".$model->id_partida."'
                            and id_clasificacion=".$model->id_clasificacion." and tipo_operacion='".$model->tipo_operacion."' and verificado=".$model->verificado;
                        $connection->createCommand($query)->execute();
                    } else {
                        $model->save();
                    }
                }
            } else {
                $model->save();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $this->actionBuscaPartida(),
            'clasificacion' => $this->actionBuscaClasificacion(),
            'unidad' => $this->actionBuscaUnidad(),
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

    public function actionBorrar($id)
    {
        $this->findModel($id)->delete();
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
    /************************************ JSON ************************************************/
    public function actionBuscarClasificaciones($id) {
        $extra="";
        if ($id!="") $extra=' and id_clasificacion='.$id;
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Clasificacion
                WHERE activo=1 $extra";
        $pendientes = $connection->createCommand($query)->queryOne();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarPartidas($id = null) {
        $extra="";
        if ($id!="") $extra=' and id_partida='.$id;
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Partida
                WHERE activo=1 $extra";
        $pendientes = $connection->createCommand($query)->queryOne();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarUnidades($id = null) {
        $extra="";
        if ($id!="") $extra=' and id_unidad='.$id;
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Unidad
                WHERE activo=1 $extra";
        $pendientes = $connection->createCommand($query)->queryOne();
        return Json::encode($pendientes);
    }
    
    public function actionBuscarDetalle($asignacion,$tipo_operacion) {
        $connection = \Yii::$app->db;

        $query = "SELECT u.id_partida,u.denominacion_partida,u.id_clasificacion,u.descripcion_clasificacion,u.observacion,
                u.id_unidad,u.monto,u.signo,u.asignacion,u.tipo_operacion,u.verificado,u.id_upa,un.descripcion as unidad
                FROM ISPR_Unidad un, ISPR_UPA u
                WHERE u.id_unidad=un.id_unidad and asignacion='$asignacion' and tipo_operacion='$tipo_operacion'
                ORDER BY id_partida,id_unidad,id_clasificacion";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
}

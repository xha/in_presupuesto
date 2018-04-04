<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Levantamiento;
use frontend\models\LevantamientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
            $hora = time();
            $hora = date('H:i:s',$hora);
            $fechat = date('Ymd H:i:s',time());
            $model->fecha = $fechat;
            $model->id_unidad = 1;
            
            $query = "SELECT count(*) as conteo
                FROM ISPR_Levantamiento
                where asignacion=".$model->asignacion." and id_unidad='".$model->id_unidad."'";
            $data1 = $connection->createCommand($query)->queryOne();
            
            if ($data1['conteo']==0) {
                $transaction = $connection->beginTransaction();
                  try {
                $model->save();
                /*************************************************************************************************/
                //Fila	Item	Partida	Clasificación	UM	Naturaleza	Mes	Cantidad	Precio	Total	Indice	Observación
                //  0   1       2       3               4       5               6       7               8       9       10      11
                $detalle = explode("¬",$_POST['i_items']);
                for ($i=0;$i < count($detalle) - 1;$i++) {
                    $campos = explode("#",$detalle[$i]);
                    $query = "SELECT descripcion
                        FROM ISPR_Partida
                        where id_partida=".$campos[2];
                    $partida = $connection->createCommand($query)->queryOne();

                    $query = "SELECT descripcion
                        FROM ISPR_Clasificacion
                        where id_clasificacion=".$campos[3];
                    $clasificacion = $connection->createCommand($query)->queryOne();
                    
                    
                    $query = "INSERT INTO ISPR_LevantamientoDetalle(id_levantamiento,id_naturaleza,id_partida,id_clasificacion,id_unidad_medida,
                        descripcion_clasificacion,descripcion_partida,rubro,cantidad,precio,total,indice,mes,observacion) VALUES (".$model->id_levantamiento.",
                        ".$campos[5].",".$campos[2].",".$campos[3].",".$campos[4].",'".$clasificacion['descripcion']."','".$partida['descripcion']."','".$campos[1]."',
                        ".$campos[7].",".$campos[8].",".$campos[9].",".$campos[10].",".$campos[6].",'".$campos[11]."');";
                    $connection->createCommand($query)->execute();
                }
                $transaction->commit();
                } catch (\Exception $msg) {
                    $transaction->rollBack();
                    throw $msg;
                } catch (\Throwable $msg) {
                    $transaction->rollBack();
                    throw $msg;
                }
            }
            
            return $this->redirect(['update', 'id' => $model->id_levantamiento]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_levantamiento]);
        }

        return $this->render('update', [
            'model' => $model,
            'partida' => $partida,
            'clasificacion' => $clasificacion,
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
    /**************** BUSQUEDAS ***********************************************************/ 
    public function actionBuscarPartida($partida) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Partida
                WHERE id_partida=".$partida." and activo=1";
        $pendientes = $connection->createCommand($query)->queryOne();
        return Json::encode($pendientes);
    }
}

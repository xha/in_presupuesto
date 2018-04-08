<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\PartidasCuentas;
use frontend\Models\PartidasCuentasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * PartidasCuentasController implements the CRUD actions for PartidasCuentas model.
 */
class PartidasCuentasController extends Controller
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
     * Lists all PartidasCuentas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartidasCuentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PartidasCuentas model.
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
     * Creates a new PartidasCuentas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PartidasCuentas();
        $connection = \Yii::$app->db;
        $partida = array();
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida,denominacion FROM ISPR_Partida where activo=1 and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida']." - ".$data1[$i]['denominacion'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $query = "SELECT id_pc FROM ISPR_Partidas_CtasC where id_partida='".$model->id_partida."' and id_cuenta='".$model->id_cuenta."'";
            $data = $connection->createCommand($query)->queryOne();
            
            $id=0;
            if ($data['id_pc']!="") {
                $query = "UPDATE ISPR_Partidas_CtasC SET activo=".$model->activo." where id_partida='".$model->id_partida."' and id_cuenta='".$model->id_cuenta."'";
                $connection->createCommand($query)->execute();
                $id=$data['id_pc'];
            } else {
                $model->save();
                $id=$model->id_pc;
            }
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
            'partida' => $partida,
        ]);
    }

    /**
     * Updates an existing PartidasCuentas model.
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
        /********************** PARTIDAS ***************************************/
        $query = "SELECT id_partida,denominacion FROM ISPR_Partida where activo=1 and movimiento=1 order by id_partida desc";
        $data1 = $connection->createCommand($query)->queryAll();
        for($i=0;$i<count($data1);$i++) {
            $partida[]= $data1[$i]['id_partida']." - ".$data1[$i]['denominacion'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $query = "SELECT count(*) as conteo FROM ISPR_Partidas_CtasC where id_partida='".$model->id_partida."' and id_cuenta='".$model->id_cuenta."'";
            $data = $connection->createCommand($query)->queryOne();
            if ($data['conteo']>0) {
                $query = "UPDATE ISPR_Partidas_CtasC SET activo=".$model->activo." where id_partida='".$model->id_partida."' and id_cuenta='".$model->id_cuenta."'";
                $connection->createCommand($query)->execute();
            } else {
                $model->save();
            }
            
            return $this->redirect(['view', 'id' => $model->id_pc]);
        }

        return $this->render('update', [
            'model' => $model,
            'partida' => $partida,
        ]);
    }

    /**
     * Deletes an existing PartidasCuentas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $query = "UPDATE ISPR_Partidas_CtasC SET activo=0 WHERE id_pc=".$id;
        $connection->createCommand($query)->query();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PartidasCuentas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PartidasCuentas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PartidasCuentas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /******************************** JSON ******************************************/
    public function actionBuscarCuenta($id) {
        $connection = \Yii::$app->db;

        $query = "SELECT count(*) as conteo FROM ISPR_Partidas_CtasC
                WHERE id_cuenta='".$id."'";
        $pendientes = $connection->createCommand($query)->queryOne();
        return $pendientes['conteo'];
    }
}

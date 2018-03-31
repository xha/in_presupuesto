<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ClasificacionUnidad;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

/**
 * ClasificacionUnidadController implements the CRUD actions for ClasificacionUnidad model.
 */
class ClasificacionUnidadController extends Controller
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
     * Lists all ClasificacionUnidad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClasificacionUnidad::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClasificacionUnidad model.
     * @param integer $id_clasificacion
     * @param integer $id_unidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_clasificacion, $id_unidad)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_clasificacion, $id_unidad),
        ]);
    }

    /**
     * Creates a new ClasificacionUnidad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClasificacionUnidad();
        $connection = \Yii::$app->db;
        $nivel_unidad = "";
        $nivel_clasificacion = "";
        /********************** UNIDADES ***************************************/
        $query = "SELECT nivel FROM ISPR_Unidad where activo=1 group by nivel";
        $nivel_unidad = $connection->createCommand($query)->queryAll();
        /********************** CLASIFICACION **********************************/
        $query = "SELECT nivel FROM ISPR_Clasificacion where activo=1 group by nivel";
        $nivel_clasificacion = $connection->createCommand($query)->queryAll();
        /***********************************************************************/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id_clasificacion' => $model->id_clasificacion, 'id_unidad' => $model->id_unidad]);
            return $this->redirect(['clasificacion-unidad/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'nivel_unidad' => Json::encode($nivel_unidad),
            'nivel_clasificacion' => Json::encode($nivel_clasificacion),
        ]);
    }

    /**
     * Updates an existing ClasificacionUnidad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_clasificacion
     * @param integer $id_unidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_clasificacion, $id_unidad)
    {
        $model = $this->findModel($id_clasificacion, $id_unidad);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_clasificacion' => $model->id_clasificacion, 'id_unidad' => $model->id_unidad]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClasificacionUnidad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_clasificacion
     * @param integer $id_unidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_clasificacion, $id_unidad)
    {
        $this->findModel($id_clasificacion, $id_unidad)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClasificacionUnidad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_clasificacion
     * @param integer $id_unidad
     * @return ClasificacionUnidad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_clasificacion, $id_unidad)
    {
        if (($model = ClasificacionUnidad::findOne(['id_clasificacion' => $id_clasificacion, 'id_unidad' => $id_unidad])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**************** BUSQUEDAS ***********************************************************/ 
    public function actionBuscarUnidad($nivel,$actual) {
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Unidad 
                WHERE nivel=".$nivel." and activo=1 and id_unidad<>$actual
                ORDER BY id_unidad,descripcion asc";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
}

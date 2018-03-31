<?php

namespace backend\controllers;

use Yii;
use backend\Models\Unidad;
use backend\Models\UnidadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

/**
 * UnidadController implements the CRUD actions for Unidad model.
 */
class UnidadController extends Controller
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
     * Lists all Unidad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UnidadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Unidad model.
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
     * Creates a new Unidad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Unidad();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->padre=="") $model->padre = 0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_unidad]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Unidad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->padre=="") $model->padre = 0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_unidad]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Unidad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $query = "UPDATE ISPR_Unidad SET activo=0 WHERE id_unidad=".$id;
        $connection->createCommand($query)->query();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Unidad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unidad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unidad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**************** BUSQUEDAS ***********************************************************/ 
    public function actionBuscarPadre($nivel,$actual) {
        $connection = \Yii::$app->db;

        $query = "SELECT * FROM ISPR_Unidad 
                WHERE nivel=".$nivel." and activo=1 and id_unidad<>$actual
                ORDER BY id_unidad,descripcion asc";
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    }
}

<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Compra;
use frontend\Models\CompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use common\models\AccessHelpers;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex($TipoCom = NULL)
    {
        if (isset($TipoCom)<>1) $TipoCom = 'L';

        $searchModel = new CompraSearch(['TipoCom' => $TipoCom]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['FechaE'=>SORT_DESC]];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'TipoCom' => $TipoCom,
        ]);
    }

    /**
     * Displays a single Compra model.
     * @param string $CodProv
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoCom
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($CodProv, $CodSucu, $NumeroD, $TipoCom)
    {
        return $this->render('view', [
            'model' => $this->findModel($CodProv, $CodSucu, $NumeroD, $TipoCom),
        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compra();
        $connection = \Yii::$app->db;
        $data = array();
        $items = array();
        $msg = "";
        /********************** PROVEEDORES ***************************************/
        $query = "SELECT CodProv,Descrip FROM SAPROV where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['CodProv']." - ".$data1[$i]['Descrip'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            date_default_timezone_set("America/Caracas");
            $hora = time();
            $hora = date('H:i:s',$hora);
            $fechat = date('Ymd H:i:s',time());
            $arr_fecha_compra=explode("-",$model->FechaE);
            $model->FechaE = $fechat;
            $model->FechaV = $model->FechaE;
            $model->FechaI = $model->FechaE;
            $model->FechaT = $model->FechaE;
            $model->CodEsta = substr(gethostname(),0,9) ;
            /*************************************************************************************************/
            //BUSCO EL CORRELATIVO QUE SIGUE
            $query = "SELECT ValueInt as largo FROM SACORRELSIS WHERE FieldName='LenCorrel'";
            $correlativo = $connection->createCommand($query)->queryOne();
            
            $prx = "PrxOrdenC";
            
            $query = "SELECT ValueInt FROM SACORRELSIS WHERE FieldName='$prx'";
            $correlsis = $connection->createCommand($query)->queryOne();
            $nro="";
            if (strlen($correlsis['ValueInt']+1) < $correlativo['largo']) {
                for ($i=1;$i<=$correlativo['largo'];$i++) {
                    $nro.="0";
                }
            }
            $nro = $nro.($correlsis['ValueInt']+1);
            
            $model->NumeroD = $nro;
            /*************************************************************************************************/
            //BUSCO DATOS DEL PROVEEDOR
            $query = "SELECT * FROM SAPROV WHERE CodProv='".$model->CodProv."'";
            $proveedor = $connection->createCommand($query)->queryOne();
            //print_r($_POST);die;
            //if($model->validate()) {
            $model->Direc1 = $proveedor['Direc1'];
            $model->Direc2 = $proveedor['Direc2'];
            $model->ID3 = $proveedor['ID3'];
            $model->Descrip = $proveedor['Descrip'];
            /*************************************************************************************************/
            if ($model->validate()) {
                $transaction = $connection->beginTransaction();
                  try {
                    $model->save();
                    /*************************************************************************************************/
                    //AUMENTO EL CORRELATIVO DEL DOCUMENTO
                    $query = "UPDATE SACORRELSIS SET ValueInt=(ValueInt+1) WHERE FieldName='$prx'";
                    $connection->createCommand($query)->query();
                    /*************************************************************************************************/
                    $detalle = explode("¬",$_POST['i_items']);
                    $total_gravable = 0;
                    $total_exento = 0;
                    for ($i=0;$i < count($detalle) - 1;$i++) {
                        $campos = explode("#",$detalle[$i]);
                        $descrip1 = substr($campos[2],0,40);
                        $descrip2 = substr($campos[2],40,40);
                        $descrip3 = substr($campos[2],80,40);
                        //Nro	Código	Descripción	Cantidad	Precio	Impuesto	Total	Serv
                        if ($campos[5]>0) {
                            $exento = 0;
                            $total_exento+=($campos[3]*$campos[4]);
                        } else {
                            $total_gravable+=($campos[3]*$campos[4]);
                            $exento = 1;
                        }
                        
                        $query2 = "INSERT INTO SAITEMCOM(CodSucu,CodProv,TipoCom,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,Descrip1,Descrip2,Descrip3,Refere,Signo,
                                Cantidad,TotalItem,Costo,Precio,MtoTax,Descto,NroUnicoL,FechaE,EsServ,EsExento,Descrip10) VALUES ('".$model->CodSucu."','".$model->CodProv."','".$model->TipoCom."','".$model->NumeroD."',
                                ".($i+1).",0,'".$campos[1]."','".$model->CodUbic."','".$descrip1."','".$descrip2."','".$descrip3."','".$campos[1]."',1,".$campos[3].",
                                ".$campos[6].",".$campos[4].",".$campos[4].",".$campos[5].",".$campos[4].",0,'".$model->FechaE."',".$campos[7].",$exento,'".$model->Notas10."');";
                        $connection->createCommand($query2)->query();
                    }
                    //SAFACT
                    $query2 = "UPDATE SACOMP SET TExento=".$total_exento.",TGravable=".$total_gravable.",Credito=".($total_gravable+$total_exento)."
                            WHERE NumeroD='".$model->NumeroD."' and TipoCom='".$model->TipoCom."'";
                    $connection->createCommand($query2)->execute();
                  $transaction->commit();
                } catch (\Exception $msg) {
                    $transaction->rollBack();
                    throw $msg;
                } catch (\Throwable $msg) {
                    $transaction->rollBack();
                    throw $msg;
                }

                return $this->redirect(['compra/index']);
            } else {
                $msg = Json::encode($model->getErrors());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
            'msg' => $msg
        ]);
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $CodProv
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoCom
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($CodProv, $CodSucu, $NumeroD, $TipoCom)
    {
        $connection = \Yii::$app->db;
        $model = $this->findModel($CodProv, $CodSucu, $NumeroD, $TipoCom);
        $data = array();
        $items = array();
        $msg = "";
        /********************** PROVEEDORES ***************************************/
        $query = "SELECT CodProv,Descrip FROM SAPROV where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['CodProv']." - ".$data1[$i]['Descrip'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            /*************************************************************************************************/
            if ($model->validate()) {
                $transaction = $connection->beginTransaction();
                  try {
                    date_default_timezone_set("America/Caracas");
                    $hora = time();
                    $hora = date('H:i:s',$hora);
                    $arr_fecha_compra=explode(" ",$model->FechaE);
                    $arr_fecha_compra=explode("-",$arr_fecha_compra[0]);
                    
                    $model->FechaE = $arr_fecha_compra[0].$arr_fecha_compra[1].$arr_fecha_compra[2]." ".$hora;
                    $model->save();
                    /*************************************************************************************************/
                    //BORRO LOS ANTIGÜOS ITEMS
                    $query = "DELETE FROM SAITEMCOM WHERE TipoCom='".$TipoCom."' AND NumeroD='".$NumeroD."' and CodProv='".$CodProv."'";
                    $connection->createCommand($query)->query();
                    /*************************************************************************************************/
                    $detalle = explode("¬",$_POST['i_items']);
                    $total_gravable = 0;
                    $total_exento = 0;
                    for ($i=0;$i < count($detalle) - 1;$i++) {
                        $campos = explode("#",$detalle[$i]);
                        $descrip1 = substr($campos[2],0,40);
                        $descrip2 = substr($campos[2],40,40);
                        $descrip3 = substr($campos[2],80,40);
                        //Nro	Código	Descripción	Cantidad	Precio	Impuesto	Total	Serv
                        if ($campos[5]>0) {
                            $exento = 0;
                            $total_exento+=($campos[3]*$campos[4]);
                        } else {
                            $total_gravable+=($campos[3]*$campos[4]);
                            $exento = 1;
                        }
                        
                        $query2 = "INSERT INTO SAITEMCOM(CodSucu,CodProv,TipoCom,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,Descrip1,Descrip2,Descrip3,Refere,Signo,
                                Cantidad,TotalItem,Costo,Precio,MtoTax,Descto,NroUnicoL,FechaE,EsServ,EsExento,Descrip10) VALUES ('".$model->CodSucu."','".$model->CodProv."','".$model->TipoCom."','".$model->NumeroD."',
                                ".($i+1).",0,'".$campos[1]."','".$model->CodUbic."','".$descrip1."','".$descrip2."','".$descrip3."','".$campos[1]."',1,".$campos[3].",
                                ".$campos[6].",".$campos[4].",".$campos[4].",".$campos[5].",".$campos[4].",0,'".$model->FechaE."',".$campos[7].",$exento,'".$model->Notas10."');";
                        $connection->createCommand($query2)->query();
                    }
                    //SAFACT
                    $query2 = "UPDATE SACOMP SET TExento=".$total_exento.",TGravable=".$total_gravable.",Credito=".($total_gravable+$total_exento)."
                            WHERE NumeroD='".$model->NumeroD."' and TipoCom='".$model->TipoCom."' and CodProv='".$model->CodProv."'";
                    $connection->createCommand($query2)->execute();
                  $transaction->commit();
                } catch (\Exception $msg) {
                    $transaction->rollBack();
                    throw $msg;
                } catch (\Throwable $msg) {
                    $transaction->rollBack();
                    throw $msg;
                }

                return $this->redirect(['compra/?TipoCom='.$model->TipoCom]);
            } else {
                $msg = Json::encode($model->getErrors());
            }
            //return $this->redirect(['view', 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoCom' => $model->TipoCom]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
            'msg' => $msg
        ]);
    }

    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $CodProv
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoCom
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($CodProv, $CodSucu, $NumeroD, $TipoCom)
    {
        //$this->findModel($CodProv, $CodSucu, $NumeroD, $TipoCom)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $CodProv
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoCom
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($CodProv, $CodSucu, $NumeroD, $TipoCom)
    {
        if (($model = Compra::findOne(['CodProv' => $CodProv, 'CodSucu' => $CodSucu, 'NumeroD' => $NumeroD, 'TipoCom' => $TipoCom])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /***********************************************************************************************************************/
    public function actionBuscarProveedor($prov) {
        $connection = \Yii::$app->db;

        $query = "SELECT * from SAPROV where Activo=1 and CodProv='".$prov."'";
        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        return Json::encode($pendientes);
    }    
    
    public function actionBuscarDetalleCompra($numerod, $tipocom, $codprov) {
        $connection = \Yii::$app->db;

        $query = "SELECT *
                FROM SAITEMCOM
                WHERE NumeroD='".$numerod."' and TipoCom='".$tipocom."' and CodProv='".$codprov."'
                ORDER BY NroLinea";
        
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    } 
}

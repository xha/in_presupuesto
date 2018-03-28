<?php

namespace frontend\controllers;

use Yii;
use frontend\Models\Venta;
use frontend\Models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use common\models\AccessHelpers;
/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
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
     * Lists all Venta models.
     * @return mixed
     */
    public function actionIndex($TipoFac = NULL)
    {
        if (isset($TipoFac)<>1) $TipoFac = 'F';

        $searchModel = new VentaSearch([ 'TipoFac' => $TipoFac]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['FechaE'=>SORT_DESC]];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'TipoFac' => $TipoFac,
        ]);
    }

    /**
     * Displays a single Venta model.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($CodSucu, $NumeroD, $TipoFac)
    {
        return $this->render('view', [
            'model' => $this->findModel($CodSucu, $NumeroD, $TipoFac),
        ]);
    }

    /**
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venta();
        $connection = \Yii::$app->db;
        $data = array();
        $items = array();
        $msg = "";
        /********************** CLIENTES ***************************************/
        $query = "SELECT CodClie,Descrip FROM SACLIE where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['CodClie']." - ".$data1[$i]['Descrip'];
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
            
            $prx = "PrxProf";
            /*switch ($model->TipoFac) {
                case "A":
                    $prx = "PrxFact";
                break;
                case "B":
                    $prx = "PrxDevVta";
                break;
                case "C":
                    $prx = "PrxNotaEn";
                break;
                case "D":
                    $prx = "PrxDevNEV";
                break;
                case "E":
                    $prx = "PrxPedido";
                break;
                default: 
                    $prx = "PrxProf";
            }*/
            
            $query = "SELECT ValueInt,Prefijo FROM SACORRELSIS WHERE FieldName='$prx'";
            $correlsis = $connection->createCommand($query)->queryOne();
            $nro="";
            if (strlen($correlsis['Prefijo'].($correlsis['ValueInt']+1)) < $correlativo['largo']) {
                for ($i=1;$i<=$correlativo['largo'];$i++) {
                    $nro.="0";
                }
            }
            $nro = $correlsis['Prefijo'].$nro.($correlsis['ValueInt']+1);
            
            $model->NumeroD = $nro;
            /*************************************************************************************************/
            //BUSCO DATOS DEL CLIENTE
            $query = "SELECT * FROM SACLIE WHERE CodClie='".$model->CodClie."'";
            $cliente = $connection->createCommand($query)->queryOne();
            //print_r($_POST);die;
            //if($model->validate()) {
            $model->Direc1 = $cliente['Direc1'];
            $model->Direc2 = $cliente['Direc2'];
            $model->ID3 = $cliente['ID3'];
            $model->Descrip = $cliente['Descrip'];
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
                        
                        $query2 = "INSERT INTO SAITEMFAC(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,CodVend,Descrip1,Descrip2,Descrip3,Refere,Signo,
                                CantMayor,Cantidad,TotalItem,Costo,Precio,MtoTax,PriceO,Descto,NroUnicoL,FechaE,EsServ,EsExento,Descrip10) VALUES ('".$model->CodSucu."','".$model->TipoFac."','".$model->NumeroD."',
                                ".($i+1).",0,'".$campos[1]."','".$model->CodUbic."','".$model->CodVend."','".$descrip1."','".$descrip2."','".$descrip3."','".$campos[1]."',1,".$campos[3].",".$campos[3].",
                                ".$campos[6].",".$campos[4].",".$campos[4].",".$campos[5].",".$campos[4].",0,0,'".$model->FechaE."',".$campos[7].",$exento,'".$model->Notas10."');";
                        $connection->createCommand($query2)->query();
                    }
                    //SAFACT
                    $query2 = "UPDATE SAFACT SET TExento=".$total_exento.",TGravable=".$total_gravable.",Credito=".($total_gravable+$total_exento)."
                            WHERE NumeroD='".$model->NumeroD."' and TipoFac='".$model->TipoFac."'";
                    $connection->createCommand($query2)->execute();
                  $transaction->commit();
                } catch (\Exception $msg) {
                    $transaction->rollBack();
                    throw $msg;
                } catch (\Throwable $msg) {
                    $transaction->rollBack();
                    throw $msg;
                }

                return $this->redirect(['venta/index']);
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
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($CodSucu, $NumeroD, $TipoFac)
    {
        $connection = \Yii::$app->db;
        $model = $this->findModel($CodSucu, $NumeroD, $TipoFac);
        $data = array();
        $items = array();
        $msg = "";
        /********************** CLIENTES ***************************************/
        $query = "SELECT CodClie,Descrip FROM SACLIE where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['CodClie']." - ".$data1[$i]['Descrip'];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            /*************************************************************************************************/
            if ($model->validate()) {
                $transaction = $connection->beginTransaction();
                  try {
                    $hora = time();
                    $hora = date('H:i:s',$hora);
                    $arr_fecha_compra=explode(" ",$model->FechaE);
                    $arr_fecha_compra=explode("-",$arr_fecha_compra[0]);
                    
                    $model->FechaE = $arr_fecha_compra[0].$arr_fecha_compra[1].$arr_fecha_compra[2]." ".$hora;  
                    $model->save();
                    /*************************************************************************************************/
                    //BORRO LOS ANTIGÜOS ITEMS
                    $query = "DELETE FROM SAITEMFAC WHERE TipoFac='".$TipoFac."' AND NumeroD='".$NumeroD."'";
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
                        $query2 = "INSERT INTO SAITEMFAC(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,CodVend,Descrip1,Descrip2,Descrip3,Refere,Signo,
                                CantMayor,Cantidad,TotalItem,Costo,Precio,MtoTax,PriceO,Descto,NroUnicoL,FechaE,EsServ,EsExento,Descrip10) VALUES ('".$model->CodSucu."','".$model->TipoFac."','".$model->NumeroD."',
                                ".($i+1).",0,'".$campos[1]."','".$model->CodUbic."','".$model->CodVend."','".$descrip1."','".$descrip2."','".$descrip3."','".$campos[1]."',1,".$campos[3].",".$campos[3].",
                                ".$campos[6].",".$campos[4].",".$campos[4].",".$campos[5].",".$campos[4].",0,0,'".$model->FechaE."',".$campos[7].",$exento,'".$model->Notas10."');";
                        $connection->createCommand($query2)->query();
                    }
                    //SAFACT
                    $query2 = "UPDATE SAFACT SET TExento=".$total_exento.",TGravable=".$total_gravable.",Credito=".($total_gravable+$total_exento).",TotalPrd=".($total_gravable+$total_exento)."
                            WHERE NumeroD='".$model->NumeroD."' and TipoFac='".$model->TipoFac."'";
                    $connection->createCommand($query2)->execute();
                  $transaction->commit();
                } catch (\Exception $msg) {
                    $transaction->rollBack();
                    throw $msg;
                } catch (\Throwable $msg) {
                    $transaction->rollBack();
                    throw $msg;
                }

                return $this->redirect(['venta/?TipoFac='.$model->TipoFac]);
            } else {
                $msg = Json::encode($model->getErrors());
            }
            //return $this->redirect(['view', 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoFac' => $model->TipoFac]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
            'msg' => $msg
        ]);
    }

    /**
     * Deletes an existing Venta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($CodSucu, $NumeroD, $TipoFac)
    {
        //$this->findModel($CodSucu, $NumeroD, $TipoFac)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($CodSucu, $NumeroD, $TipoFac)
    {
        if (($model = Venta::findOne(['CodSucu' => $CodSucu, 'NumeroD' => $NumeroD, 'TipoFac' => $TipoFac])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /***********************************************************************************************************************/
    public function actionBuscarCliente($cliente) {
        $connection = \Yii::$app->db;

        $query = "SELECT * from SACLIE where Activo=1 and CodClie='".$cliente."'";
        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
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
    
    public function actionBuscarDetalleVenta($numerod, $tipofac) {
        $connection = \Yii::$app->db;

        $query = "SELECT *
                FROM SAITEMFAC
                WHERE NumeroD='".$numerod."' and TipoFac='".$tipofac."'
                ORDER BY NroLinea";
        
        $pendientes = $connection->createCommand($query)->queryAll();
        return Json::encode($pendientes);
    } 
}

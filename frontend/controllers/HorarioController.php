<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Asistencia;
use frontend\models\AsistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;
use kartik\mpdf\Pdf;

/**
 * AsistenciaController implements the CRUD actions for Asistencia model.
 */
class HorarioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','update','delete','reporteasistencia'],
                'rules' => [
                    [
                        'actions' => ['index','create','view','update','delete','reporteasistencia'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Asistencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsistenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['fkuser'=>Yii::$app->user->getId()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asistencia model.
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
     * Creates a new Asistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $horario = new Asistencia;
        $purifier = new HtmlPurifier;
        $horaE  = '11:20:00';
        $lhoraE = '11:40:00';
        $horaS  = '11:42:00';
        $lhoraS = '11:50:00';

        if ( $horario->load(Yii::$app->request->post()) ) {
            if ( $horario->validate() ) {
                $paramget = isset($_GET['uma']) ? $purifier->process($_GET['uma']) : null;
                // si @var paramget es null marcara solo la entrada
                if ($paramget == null) {
                    $horario->fkuser = Yii::$app->user->getId();
                    $horario->fecha = date( "Y-m-d",time() );
                    $horario->horain = date( "h:i:s",time() );
                    if ( $horario->save() ) {
                        return $this->redirect(['view', 'id' => $horario->idasis]);
                    }
                }else {
                    //consulta si el usuario marco la entrada, entonces se marcara la salida
                    $fecha	= date( "Y-m-d",time() );
                    $asist = Asistencia::find()->where(['fecha'=>$fecha])->andWhere(['fkuser'=>Yii::$app->user->getId()])->one();
                    if ( $asist !== null) {
                        $asist->horaout = date( "h:i:s",time() );
                        $asist->observacion = $horario->observacion;
                        if ( $asist->save() ) {
                            $horario = $asist;
                            return $this->redirect(['view', 'id' => $horario->idasis]);
                        }
                    }else {//else marcara solo la salida sin una entrada marcada
                        $horario->fkuser = Yii::$app->user->getId();
                        $horario->fecha = date( "Y-m-d",time() );
                        $horario->horaout = date( "h:i:s",time() );
                        if ( $horario->save() ) {
                            return $this->redirect(['view', 'id' => $horario->idasis]);
                        }
                    }
                }
            }
        }

        return $this->render('create', [
            'horario'   => $horario,
            'horaE'     => $horaE,
            'horaS'     => $horaS,
            'lhoraE'    => $lhoraE,
            'lhoraS'    => $lhoraS
        ]);
    }

    /**
     * Updates an existing Asistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idasis]);
        }*/

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asistencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $this->findModel($param)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Asistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asistencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    *   @method reporteasistencia
    *
    */
    public function actionReporteasistencia()
    {
        $mpdf = null;
        $conteo = null;
        $finicio = null;
        $ffin = null;
        $mes = null;
        $asistencia = null;
        $horario = new Asistencia;

        // MEDIDAS DE HOJA A4 WIDTH='992PX' HEIGHT='1403PX'
		if ( $horario->load(Yii::$app->request->post()) )
        {
            if ( !empty($horario->mes)  ) {
                $mes = $horario->mes;
                $anio = date('Y');
                $fechainicio = "$anio-$mes-01";

                if ($mes == 12) {
                    $anionuevo = $anio + 1;
                    $fechafinal = "$anioNuevo-01-01";
                }else {
                    $mesnuevo = $mes + 1;
                    $mesnuevo = $mesnuevo;
                    $fechafinal = "$anio-$mesnuevo-01";
                }
                $asistencia = Asistencia::find()
                            ->where(['>=','fecha',$fechainicio])
                            ->andWhere(['<','fecha',$fechafinal])
                            ->andWhere(['fkuser'=>Yii::$app->user->getId()])->all();
                $conteo = Asistencia::find()
                        ->where(['>=','fecha',$fechainicio])
                        ->andWhere(['<','fecha',$fechafinal])
                        ->andWhere(['fkuser'=>Yii::$app->user->getId()])->count();
            }
            if( !empty($horario->fechain) && !empty($horario->fechaout) ){
                $finicio = $horario->fechain;
                $ffin = $horario->fechaout;
                $asistencia = Asistencia::find()
                            ->where(['>=','fecha',$finicio])
                            ->andWhere(['<=','fecha',$ffin])->all();
                $conteo = Asistencia::find()
                        ->where(['>=','fecha',$finicio])
                        ->andWhere(['<=','fecha',$ffin])->count();
            }
            if ( $conteo > 0 ) {
                $registros	= 6; // maximo de registros a mostrar en el PDF
                $incre		= 0;
                $control 	= 0;
                $contador	= (integer)$conteo; // variable de incremento

                //API MPDF
                $pdf = Yii::$app->pdf;
                $API = $pdf->api;
                $API->SetDisplayMode('fullpage');
                $API->marginHeader=0;
                $API->marginFooter=0;
                $API->setAutoTopMargin='pad';
                $API->setAutoBottomMargin='true';
                
                $header = "<img style='vertical-align: top;' src=".Yii::$app->basePath.'/web/img/printpdf/bannerfundabit.jpg'.">";
                $footer = "<img src=".Yii::$app->basePath.'/web/img/printpdf/cintillomppe.jpg'.">";
                
                $API->SetHTMLHeader( $header,1 );
                $API->SetFooter('{PAGENO}');
                $API->SetHTMLFooter( $footer,1 );
                $API->WriteHTML(file_get_contents(Yii::$app->basePath.'/web/css/csspdf.css'),1);
                $pdfFilename = !empty($mes) ? 'Reporte_del_mes_'.$mes.'.pdf' : 'Reporte_de_'.$finicio.'_a_'.$ffin.'.pdf';

                foreach ($asistencia as $key => $value):
                    if ($incre == $registros) {
                        if ( !empty($mes) ) {
                            $vista = $this->renderPartial('_reporteAsistencia',[
                                'horario'=>$asist,
                                'mes'=>$mes
                            ]);
                            //$API = $this->cargarVista($vista,$pdfFilename);
                            $API->WriteHTML($vista); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
                        }else {
                            $vista = $this->renderPartial('_reporteAsistencia',[
                                'horario'=>$asist,
                                'finicio'=>$finicio,
                                'ffin'=>$ffin
                            ]);
                            //$API = $this->cargarVista($vista,$pdfFilename);
                            $API->WriteHTML($vista);
                        }
                        $API->AddPage('P');
                        unset($asist); // VACIA $eq PARA VOLVER A INICIALIZARLA
                        $incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
                    }
                    $asist[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
                    $incre++;
                    $control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
                    // IMPRIME EL RESTO DE LOS REGISTROS
                    if ($control == $contador) {
                        if ( !empty($mes) ) {
                            $vista = $this->renderPartial('_reporteAsistencia',[
                                'horario'=>$asist,
                                'mes'=>$mes
                            ]);
                            //$API = $this->cargarVista($vista,$pdfFilename);
                            $API->WriteHTML($vista); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
                        }else {
                            $vista = $this->renderPartial('_reporteAsistencia',[
                                'horario'=>$asist,
                                'finicio'=>$finicio,
                                'ffin'=>$ffin
                            ]);
                            //$API = $this->cargarVista($vista,$pdfFilename);
                            $API->WriteHTML($vista);
                        }
                        unset($asist);
                    }
                endforeach;
                //return $API->render();
                $API->Output( $pdfFilename, 'D' );
                exit;
            }//end if conteo
		}

        return $this->render('reportepdf',[
            'horario'=>$horario
        ]);
    }

    /**
    *   @method cargarVista
    *
    */
    protected function cargarVista($vista,$pdfFilename)
    {
        return new Pdf([
            'mode' => Pdf::MODE_UTF8,// set to use core fonts only
            'format' => Pdf::FORMAT_A4,// A4 paper format
            'orientation' => Pdf::ORIENT_PORTRAIT,// portrait orientation
            'destination' => Pdf::DEST_DOWNLOAD,// stream to browser inline
            'defaultFontSize'=>12,
            'marginLeft'=>0,
            'marginRight'=>0,
            'marginTop'=>0,
            'marginBottom'=>0,
            'content' => $vista,// your html content input
            'filename'=>$pdfFilename,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',// any css to be embedded if required
            //'options' => ['title' => 'Krajee Report Title'],// set mPDF properties on the fly
            /*'methods' => [// call mPDF methods on the fly
                //'SetHeader'=>['Krajee Report Header'],
                //'SetFooter'=>['{PAGENO}'],
            ]*/
        ]);
    }
}

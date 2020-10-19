<?php

namespace frontend\controllers;

use Yii;
use yii\base\ErrorException;
use frontend\models\Estado;
use frontend\models\Municipio;
use frontend\models\Parroquia;
use frontend\models\Sedeciat;
use frontend\models\Insteduc;
use frontend\models\Representante;
use frontend\models\Direcuser;
use frontend\models\Estudiante;
use frontend\models\Niveleduc;
use frontend\models\Equipo;
use frontend\models\EquipoSearch;
use frontend\models\Formato;
use frontend\models\FormatoSearch;
use frontend\models\Fsoftware;
use frontend\models\Fpantalla;
use frontend\models\Ftarjetamadre;
use frontend\models\Fteclado;
use frontend\models\Fcarga;
use frontend\models\Fgeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\web\Response;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class CanaimitaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','marcar'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','marcar'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $actasArray = Formato::find()->asArray()->where(['opcion'=>'acta'])->andWhere(['statusacta'=>'1'])->all();
        $fsearchModel = new FormatoSearch;
        $fdataProvider = $fsearchModel->search(Yii::$app->request->queryParams);
        // colocar un if para el tutor solamente
        //$fdataProvider->query->where(['status'=>'0'])->all();
        $csearchModel = new EquipoSearch;
        $cdataProvider = $csearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'fsearchModel' => $fsearchModel,
            'fdataProvider' => $fdataProvider,
            'csearchModel' => $csearchModel,
            'cdataProvider' => $cdataProvider,
            'actasArray'=>$actasArray
        ]);
    }

    /**
     * Displays a single Equipo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'canaimita' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $estado         =   new     Estado;
        $municipio      =   new     Municipio;
        $parroquia      =   new     Parroquia;
        $estadoArray    =   Estado::find()->asArray()->all();
        $municipioArray =   Municipio::find()->asArray()->all();
        $parroquiaArray =   Parroquia::find()->asArray()->all();
        $sedeciat       =   new     Sedeciat;
        $insteduc       =   new     Insteduc;
        $representante  =   new     Representante;
        $direcuser      =   new     Direcuser;
        $estudiante     =   new     Estudiante;
        $niveleduc      =   new     Niveleduc;
        $equipo         =   new     Equipo;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        if (
            $estado->load(Yii::$app->request->post()) &&
            $municipio->load(Yii::$app->request->post()) &&
            $parroquia->load(Yii::$app->request->post()) &&
            $sedeciat->load(Yii::$app->request->post()) &&
            $insteduc->load(Yii::$app->request->post()) &&
            $representante->load(Yii::$app->request->post()) &&
            $estudiante->load(Yii::$app->request->post()) &&
            $niveleduc->load(Yii::$app->request->post()) &&
            $equipo->load(Yii::$app->request->post()) &&
            $fsoftware->load(Yii::$app->request->post()) &&
            $fpantalla->load(Yii::$app->request->post()) &&
            $ftarjetamadre->load(Yii::$app->request->post()) &&
            $fteclado->load(Yii::$app->request->post()) &&
            $fcarga->load(Yii::$app->request->post()) &&
            $fgeneral->load(Yii::$app->request->post())
        ) {
            //echo "<pre>";var_dump(Yii::$app->request->post());die;
            if (
                $estado->validate() &&
                $municipio->validate() &&
                $parroquia->validate() &&
                $sedeciat->validate() &&
                $insteduc->validate() &&
                $representante->validate() &&
                $estudiante->validate() &&
                $niveleduc->validate() &&
                $equipo->validate() &&
                $fsoftware->validate() &&
                $fpantalla->validate() &&
                $ftarjetamadre->validate() &&
                $fteclado->validate() &&
                $fcarga->validate() &&
                $fgeneral->validate()
            ) {
                $transaction = $fgeneral->db->beginTransaction();
                try {
                    if ($sedeciat->save()) {
                        if ($insteduc->save()) {
                            $representante->idciat = $sedeciat->idciat;
                            $representante->fkuser = Yii::$app->user->getId();
                            $representante->idinst = $insteduc->idinst;
                            if ($representante->save()) {
                                $estudiante->idinst = $insteduc->idinst;
                                $estudiante->idrep = $representante->idrep;
                                if ($estudiante->save()) {
                                    $niveleduc->idestu = $estudiante->idestu;
                                    if ($niveleduc->save()) {
                                        $direcuser->idfkesta = $estado->idesta;
                                        $direcuser->idfkmunc = $municipio->idmunc;
                                        $direcuser->idfkpar = $parroquia->idpar;
                                        $direcuser->idfkciat = $sedeciat->idciat;
                                        $direcuser->idfkinst = $insteduc->idinst;
                                        $direcuser->idfkrep = $representante->idrep;
                                        if ($direcuser->save()) {
                                            $fecha = date( "Y-m-d h:i:s",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA
                                            $equipo->frecepcion = $fecha;
                                            $equipo->idrep = $representante->idrep;
                                            if ($equipo->save()) {
                                                $fsoftware->ideq = $equipo->ideq;
    											if ( $fsoftware->save() ) {
    												$fpantalla->ideq = $equipo->ideq;
    												if ( $fpantalla->save() ) {
    													$ftarjetamadre->ideq = $equipo->ideq;
    													if ( $ftarjetamadre->save() ) {
    														$fteclado->ideq = $equipo->ideq;
    														if ( $fteclado->save() ) {
    															$fcarga->ideq = $equipo->ideq;
    															if ( $fcarga->save() ) {
    																$fgeneral->ideq = $equipo->ideq;
    																if ( $fgeneral->save() ) {
                                                                        Yii::$app->session->setFlash('success', "La Canaimita $equipo->eqserial fue Registrada");
    																}
    															}
    														}
    													}
    												}
    											}
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $equipo->ideq]);
                } catch (ErrorException $e) {
                    $e->getMessage();die;
                    $transaction->rollback();
                    Yii::$app->session->setFlash('warning', "La Canaimita $equipo->eqserial no pudo ser registrar");
                }// fin try catch
            }/*else {
                $estado->getErrors();
                $municipio->getErrors();
                $parroquia->getErrors();
                $sedeciat->getErrors();
                $insteduc->getErrors();
                $representante->getErrors();
                $estudiante->getErrors();
                $niveleduc->getErrors();
                $equipo->getErrors();
                $fsoftware->getErrors();
                $fpantalla->getErrors();
                $ftarjetamadre->getErrors();
                $fteclado->getErrors();
                $fcarga->getErrors();
                $fgeneral->getErrors();
            }*/
        }

        return $this->render('create', [
            'estado'        =>  $estado,
            'municipio'     =>  $municipio,
            'parroquia'     =>  $parroquia,
            'estadoArray'        =>  $estadoArray,
            'municipioArray'     =>  $municipioArray,
            'parroquiaArray'     =>  $parroquiaArray,
            'sedeciat'      =>  $sedeciat,
            'insteduc'      =>  $insteduc,
            'representante' =>  $representante,
            'estudiante'    =>  $estudiante,
            'niveleduc'     =>  $niveleduc,
            'equipo'        =>  $equipo,
            'fsoftware'     =>  $fsoftware,
            'fpantalla'     =>  $fpantalla,
            'ftarjetamadre' =>  $ftarjetamadre,
            'fteclado'      =>  $fteclado,
            'fcarga'        =>  $fcarga,
            'fgeneral'      =>  $fgeneral,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier       =   new HtmlPurifier;
        $param          =   $purifier->process( Yii::$app->request->get('id') );
        $equipo         =   $this->findModel($param);
        $representante  =   Representante::find()->where(['idrep'=>$equipo->idrep])->one();
        $estudiante     =   Estudiante::find()->where(['idrep'=>$representante->idrep])->one();
        $direcuser      =   Direcuser::find()->where(['idfkrep'=>$representante->idrep])->one();
        $estado         =   new Estado;
        $municipio      =   new Municipio;
        $parroquia      =   new Parroquia;
        $estadoArray    =   Estado::find()->asArray()->where(['idesta'=>$direcuser->idfkesta])->all();
        $municipioArray =   Municipio::find()->asArray()->where(['idmunc'=>$direcuser->idfkmunc])->all();
        $parroquiaArray =   Parroquia::find()->asArray()->where(['idpar'=>$direcuser->idfkpar])->all();
        $sedeciat       =   Sedeciat::find()->where(['idciat'=>$direcuser->idfkciat])->one();
        $insteduc       =   Insteduc::find()->where(['idinst'=>$direcuser->idfkinst])->one();
        $niveleduc      =   Niveleduc::find()->where(['idestu'=>$estudiante->idestu])->one();
        $fsoftware      =   Fsoftware::find()->where(['ideq'=>$equipo->ideq])->one();
        $fpantalla      =   Fpantalla::find()->where(['ideq'=>$equipo->ideq])->one();
        $ftarjetamadre  =   Ftarjetamadre::find()->where(['ideq'=>$equipo->ideq])->one();
        $fteclado       =   Fteclado::find()->where(['ideq'=>$equipo->ideq])->one();
        $fcarga         =   Fcarga::find()->where(['ideq'=>$equipo->ideq])->one();
        $fgeneral       =   Fgeneral::find()->where(['ideq'=>$equipo->ideq])->one();

        if (
            $estado->load(Yii::$app->request->post()) &&
            $municipio->load(Yii::$app->request->post()) &&
            $parroquia->load(Yii::$app->request->post()) &&
            $sedeciat->load(Yii::$app->request->post()) &&
            $insteduc->load(Yii::$app->request->post()) &&
            $representante->load(Yii::$app->request->post()) &&
            $estudiante->load(Yii::$app->request->post()) &&
            $niveleduc->load(Yii::$app->request->post()) &&
            $equipo->load(Yii::$app->request->post()) &&
            $fsoftware->load(Yii::$app->request->post()) &&
            $fpantalla->load(Yii::$app->request->post()) &&
            $ftarjetamadre->load(Yii::$app->request->post()) &&
            $fteclado->load(Yii::$app->request->post()) &&
            $fcarga->load(Yii::$app->request->post()) &&
            $fgeneral->load(Yii::$app->request->post())
        ) {
            return $this->redirect(['view', 'id' => $equipo->ideq]);
        }

        return $this->render('update', [
            'estado'		=>	$estado,
            'municipio'		=>	$municipio,
            'parroquia'		=>	$parroquia,
            'estadoArray'       =>  $estadoArray,
            'municipioArray'    =>  $municipioArray,
            'parroquiaArray'    =>  $parroquiaArray,
            'sedeciat'		=>	$sedeciat,
            'insteduc'		=>	$insteduc,
            'representante'	=>	$representante,
            'estudiante'	=>	$estudiante,
            'niveleduc'		=>	$niveleduc,
            'equipo'		=>	$equipo,
            'fsoftware'		=>	$fsoftware,
            'fpantalla'		=>	$fpantalla,
            'ftarjetamadre'	=>	$ftarjetamadre,
            'fteclado'		=>	$fteclado,
            'fcarga'		=>	$fcarga,
            'fgeneral'		=>	$fgeneral,
        ]);
    }

    /**
     * Deletes an existing Equipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    *   @method
    *
    */
    public function actionMuncall()
    {
        $purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));
        $municipio = Municipio::find()->where(['idesta'=>$param])->all();

        if ($municipio != null) {
            echo '<option value="">---- Seleccione ----</option>';
            foreach ($municipio as $value) {
                echo "<option value=". $value->idmunc . ">". $value->municipio. "</option>";
            }
        }else{
            echo "<option>----</option>";
        }
    }

    /**
    *   @method
    *
    */
    public function actionParrall()
    {
        $purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));
        $parroquia = Parroquia::find()->where(['idmunc'=>$param])->all();

        if ($parroquia != null) {
            echo '<option value="">---- Seleccione ----</option>';
            foreach ($parroquia as $value) {
                echo "<option value=". $value->idpar . ">". $value->parroquia. "</option>";
            }
        }else{
            echo "<option>----</option>";
        }
    }

    /**
    *   @method
    *
    */
    public function actionReportespdf()
    {
        $mpdf = null;
        $conteo = null;
        $finicio = null;
        $ffin = null;
        $mes = null;
        $equipo = null;
        $canaimita      =   new     Equipo;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        // MEDIDAS DE HOJA A4 WIDTH='992PX' HEIGHT='1403PX'
        if ( $canaimita->load(Yii::$app->request->post()) )
        {
            try {
                if ( !empty($canaimita->mes) ) {
    				$mes = $canaimita->mes;
    				$anio = date('Y');
    				$fechainicio = "$anio-$mes-01";

    				if ($mes == 12) {
    					$anionuevo = $anio + 1;
    					$fechafinal = "$anioNuevo-01-01";
    				}else {
                        $mesnuevo = (int)$mes + 1;
                        $mesnuevo = $mesnuevo;
    					$fechafinal = "$anio-$mesnuevo-01";
    				}
                    $equipo = Equipo::find()->where(['>=','frecepcion',$fechainicio])->andWhere(['<','frecepcion',$fechafinal])->all();
                    $conteo = Equipo::find()->where(['>=','frecepcion',$fechainicio])->andWhere(['<','frecepcion',$fechafinal])->count();
    			}
                if ( !empty($canaimita->frecepcion) && !empty($canaimita->fentrega) ) {
    				$finicio = $canaimita->frecepcion;
    				$ffin = $canaimita->fentrega;
                    $equipo = Equipo::find()->where(['>=','frecepcion',$finicio])->andWhere(['<=','frecepcion',$ffin])->all();
                    $conteo = Equipo::find()->where(['>=','frecepcion',$finicio])->andWhere(['<=','frecepcion',$ffin])->count();
    			}

                if ( $conteo > 0 ) {
					$registros	= 6; // maximo de registros a mostrar en el PDF
					$incre		= 0;
					$control 	= 0;
					$contador	= (integer)$conteo; // variable de incremento

                    //API MPDF
                    $pdf = Yii::$app->pdf;
                    $API = $pdf->api;
                    // Yii::$app->basePath igual a Yii::$app->getBasePath()
                    $stylesheet = file_get_contents(Yii::$app->getBasePath().'/web/css/csspdf.css');
                    $API->WriteHTML($stylesheet,1);
                    $pdfFilename = !empty($mes) ? 'Reporte_del_mes_'.$mes.'.pdf' : 'Reporte_de_'.$finicio.'_a_'.$ffin.'.pdf';

					foreach ($equipo as $key => $value):
					    if ($incre == $registros) {
							if ( !empty($mes) ) {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'equipo'=>$caneq,
                                    'mes'=>$mes
                                ]);
                                //$mpdf = $this->cargarVista($vista,$pdfFilename);
                                $API->WriteHtml($vista);
							}else {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'equipo'=>$caneq,
                                    'finicio'=>$finicio,
									'ffin'=>$ffin
                                ]);
                                //$mpdf = $this->cargarVista($vista,$pdfFilename);
                                $API->WriteHtml($vista);
							}
							unset($caneq); // VACIA $caneq PARA VOLVER A INICIALIZARLA
							$incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
						}
						$caneq[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
						$incre++;
						$control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
						// IMPRIME EL RESTO DE LOS REGISTROS
						if ($control == $contador) {
                            if ( !empty($mes) ) {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'equipo'=>$caneq,
                                    'mes'=>$mes
                                ]);
                                //$mpdf = $this->cargarVista($vista,$pdfFilename);
                                $API->WriteHtml($vista);
							}else {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'equipo'=>$caneq,
                                    'finicio'=>$finicio,
									'ffin'=>$ffin
                                ]);
                                //$mpdf = $this->cargarVista($vista,$pdfFilename);
                                $API->WriteHtml($vista);
							}
                            unset($caneq); // VACIA $caneq PARA VOLVER A INICIALIZARLA
						}
					endforeach;
                    //echo "<pre>";var_dump($mpdf);die;
                    $API->Output($pdfFilename,'D');
                    //return $mpdf->render();
                    if ( !empty($canaimita->mes) ) {
                        Yii::$app->session->setFlash('success', "¡Se ha creado el reporte del $mes!");
                    }else if ( !empty($canaimita->frecepcion) && !empty($canaimita->fentrega) ) {
                        Yii::$app->session->setFlash('success', "¡Se ha creado el reporte de la Falla: $falla!");
                    }
				}
            } catch (ErrorException $e) {
                Yii::warning("¡Por favor seleccione alguna opcion de los distintos reportes...!");
                Yii::$app->session->setFlash('error', "¡Por favor!");
            }

        }

        return $this->render('reportes',[
            'canaimita'     =>  $canaimita,
            'fsoftware'		=>	$fsoftware,
            'fpantalla'		=>	$fpantalla,
            'ftarjetamadre'	=>	$ftarjetamadre,
            'fteclado'		=>	$fteclado,
            'fcarga'		=>	$fcarga,
            'fgeneral'		=>	$fgeneral,
        ]);
    }

    /**
    *   @method reporteasistencia
    *
    */
    public function cargarVista($vista,$pdfFilename)
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

    /**
    *   @method
    *
    */
    public function actionReportesfallas()
    {
        $falla          =   '';
        $conteo         =   0;
        $equipo = null;
        $canaimita      =   new     Equipo;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        try {
            if( $fsoftware->load(Yii::$app->request->post()) ){
                $falla = $fsoftware->fsoft;
                $equipo = $this->construirConsultar(new Fsoftware,'fsoft',$fsoftware->fsoft);
                $conteo = Fsoftware::find()->where(['fsoft'=>$fsoftware->fsoft])->count();
            }else
            if( $fpantalla->load(Yii::$app->request->post()) ){
                $falla = $fpantalla->fpant;
                $equipo = $this->construirConsultar(new Fpantalla,'fpant',$fpantalla->fpant);
                $conteo = Fpantalla::find()->where(['fpant'=>$fpantalla->fpant])->count();
            }else
            if( $ftarjetamadre->load(Yii::$app->request->post()) ){
                $falla = $ftarjetamadre->ftarj;
                $equipo = $this->construirConsultar(new Ftarjetamadre,'ftarj',$ftarjetamadre->ftarj);
                $conteo = Ftarjetamadre::find()->where(['ftarj'=>$ftarjetamadre->ftarj])->count();
            }else
            if( $fteclado->load(Yii::$app->request->post()) ){
                $falla = $fteclado->ftec;
                $equipo = $this->construirConsultar(new Fteclado,'ftec',$fteclado->ftec);
                $conteo = Fteclado::find()->where(['ftec'=>$fteclado->ftec])->count();
            }else
            if( $fcarga->load(Yii::$app->request->post()) ){
                $falla = $fcarga->fcarg;
                $equipo = $this->construirConsultar(new Fcarga,'fcarg',$fcarga->fcarg);
                $conteo = Fcarga::find()->where(['fcarg'=>$fcarga->fcarg])->count();
            }else
            if( $fgeneral->load(Yii::$app->request->post()) ){
                $falla = $fgeneral->fgen;
                $equipo = $this->construirConsultar(new Fgeneral,'fgen',$fgeneral->fgen);
                $conteo = Fgeneral::find()->where(['fgen'=>$fgeneral->fgen])->count();
            }

            if ( $conteo > 0 ) {
                //echo "<pre>";var_dump($equipo);die;
                $registros	= 6; // maximo de registros a mostrar en el PDF
                $incre		= 0;
                $control 	= 0;
                $contador	= (integer)$conteo; // variable de increment

                // API MPDF
                $pdf = Yii::$app->pdf;
                $mpdf = $pdf->api;
                //$mpdf->WriteHTML(file_get_contents(Yii::$app->request->baseUrl.'/css/csspdf.css'),1);

                foreach ($equipo as $key => $value) {
                    if ($incre == $registros) {
                        $vista = $this->renderPartial('_reportesFallas',[
                            'canaimita'=>$eq,
                            'falla'=>$falla
                        ]);
                        $mpdf->WriteHTML($vista);
                        $mpdf->AddPage();
                        $eq = null; // VACIA $eq PARA VOLVER A INICIALIZARLA
                        $incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
                    }
                    $eq[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
                    $incre++;
                    $control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
                    // IMPRIME EL RESTO DE LOS REGISTROS
                    if ($control == $contador) {
                        $vista = $this->renderPartial('_reportesFallas',[
                            'canaimita'=>$eq,
                            'falla'=>$falla
                        ]);
                        $mpdf->WriteHTML($vista);
                        $eq = null; // VACIA $eq PARA VOLVER A INICIALIZARLA
                    }
                }
                $mpdf->Output('Reportes_de_Falla_'.$falla.'.pdf','D');
                Yii::$app()->session->setFlash('success','El reporte ha sido Creado');
                $this->refresh();
            }
        } catch (ErrorException $e) {
            Yii::warning('Ocurrio un error en donde nose');
            Yii::$app->session->setFlash('error',"Disculpe no existe la data");
            //$this->redirect(Yii::$app->urlManager->createUrl('site/notfound') );
        }

        return $this->render('reportes', [
			'canaimita'		=>	$canaimita,
			'fsoftware'		=>	$fsoftware,
			'fpantalla'		=>	$fpantalla,
			'ftarjetamadre'	=>	$ftarjetamadre,
			'fteclado'		=>	$fteclado,
			'fcarga'		=>	$fcarga,
			'fgeneral'		=>	$fgeneral,
	    ]);
    }

    /**
	*	@method construirConsultar
	*	construye una consulta segun la falla que sea enviada por POST
	*/
	protected function construirConsultar($clase,$index,$falla){
		$modelo = $clase::find()->where("$index = :f_$index", [":f_$index" => $falla])->all();
        $conteo = $clase::find()->where("$index = :f_$index", [":f_$index" => $falla])->count();
		if ($conteo > 0) {
			foreach ($modelo as $valor) {
				$ideq[] = $valor->ideq;
			}
			return Equipo::find()->where(['in','ideq',$ideq])->all();
		}else {
			return false;
		}
	}



    /**
    *   @method actualiza el status de entrega
    *
    */
    public function actionMarcar($id)
    {
        $equipo = $this->findModel($id);
        $equipo->fentrega = date( "Y-m-d h:i:s",time() );
        $equipo->status = '1';
        if ($equipo->save()) {
            return $this->redirect(['index']);
        }else {
            return $this->redirect(['notfound']);
        }
    }

}

<?php

namespace frontend\controllers;

use Yii;
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
        $csearchModel = new EquipoSearch;
        $cdataProvider = $csearchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isPost) {
            $purifier = new HtmlPurifier;
            $valor = $purifier->process($_POST['FormatoSearch']['idf']);
            $formato = Formato::find()->where(['idf'=>$valor])->one();
            if (!$this->descargar($formato->ruta, $formato->nombf.'.'.$formato->extens ,['ods','xls','odt','docx'])) {
                Yii::$app->session->setFlash('errormsj', "el archivo no se pudo descargar");
                $this->refresh();
            }
        }

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

        if ($sedeciat->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->session->setFlash('warning', "La Sede $sedeciat->sede ya existe...");
            //$this->refresh();
            return ActiveForm::validate($sedeciat);
        }

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
                $transaction = $equipo->db->beginTransaction();
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
                } catch (Exception $e) {
                    $e->getMessage();die;
                    $transaction->rollback();
                    Yii::$app->session->setFlash('warning', "La Canaimita $equipo->eqserial no se pudo registrar");
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
    public function actionUpdate($id)
    {
        $equipo         =   $this->findModel($id);
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
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        if ($equipo->load(Yii::$app->request->post()) && $equipo->save()) {
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
    public function actionDelete($id)
    {
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
    public function actionMuncall($id)
    {
        $municipio = Municipio::find()->where(['idesta'=>$id])->all();

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
    public function actionParrall($id)
    {
        $parroquia = Parroquia::find()->where(['idmunc'=>$id])->all();

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
        $conteo = null;
        $finicio = null;
        $ffin = null;
        $mes = null;
        $equipo         =   null;
        $canaimita      =   new     Equipo;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        if (
            $canaimita->load(Yii::$app->request->post())
        ) {
            if ( !empty($canaimita->mes) ) {
				$mes = $canaimita->mes;
				$anio = date('Y');
				$fechainicio = "$anio-$mes-01";

				if ($mes == 12) {
					$anionuevo = $anio + 1;
					$fechafinal = "$anioNuevo-01-01";
				}else {
					$mesnuevo = $mes + 1;
					$fechafinal = "$anio-$mesnuevo-01";
				}
                $equipo = Equipo::find()->where(['>=','frecepcion',$fechainicio])->andWhere(['<','frecepcion',$fechafinal])->all();
                $conteo = Equipo::find()->where(['>=','frecepcion',$fechainicio])->andWhere(['<','frecepcion',$fechafinal])->count();
			}else if ( !empty($canaimita->frecepcion) && !empty($canaimita->fentrega) ) {
				$finicio = $canaimita->frecepcion;
				$ffin = $canaimita->fentrega;
                $equipo = Equipo::find()->where(['>=','frecepcion',$finicio])->andWhere(['<=','frecepcion',$ffin])->all();
                $conteo = Equipo::find()->where(['>=','frecepcion',$finicio])->andWhere(['<=','frecepcion',$ffin])->count();
			}

            try {
                if ( $equipo !== null ) {
					$registros	= 6; // maximo de registros a mostrar en el PDF
					$incre		= 0;
					$control 	= 0;
					$contador	= (integer)$conteo; // variable de incremento

                    //API MPDF
                    $pdf = Yii::$app->pdf;
                    $mpdf = $pdf->api;

					foreach ($equipo as $key => $value):
					    if ($incre == $registros) {
							if ( !empty($mes) ) {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'canaimita'=>$eq,
                                    'mes'=>$mes
                                ]);
                                $mpdf->WriteHtml($vista);
							}else {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'canaimita'=>$eq,
                                    'finicio'=>$finicio,
									'ffin'=>$ffin
                                ]);
                                $mpdf->WriteHtml($vista);
							}
							unset($eq); // VACIA $eq PARA VOLVER A INICIALIZARLA
							$incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
						}
						$eq[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
						$incre++;
						$control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
						// IMPRIME EL RESTO DE LOS REGISTROS
						if ($control == $contador) {
                            if ( !empty($mes) ) {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'canaimita'=>$eq,
                                    'mes'=>$mes
                                ]);
                                $mpdf->WriteHtml($vista);
							}else {
                                $vista = $this->renderPartial('_reportesPDF',[
                                    'canaimita'=>$eq,
                                    'finicio'=>$finicio,
									'ffin'=>$ffin
                                ]);
                                $mpdf->WriteHtml($vista);
							}
						}
					endforeach;

                    $pdfFilename = !empty($mes) ? 'Reporte_del_mes_'.$mes.'.pdf' : 'Reporte_de_'.$finicio.'_a_'.$ffin.'.pdf';
                    echo $mpdf->Output($pdfFilename,'D');
                    if (isset($mes)) {
                        Yii::$app->session->setFlash('success', "¡Se ha creado el reporte del $mes!");
                    }else {
                        Yii::$app->session->setFlash('success', "¡Se ha creado el reporte de la Falla: $falla!");
                    }
                    die;
				}
            } catch (Exception $e) {
                $e->getMessage();
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
    *   @method
    *
    */
    public function actionReportesfallas()
    {
        $falla          =   '';
        $conteo         =   0;
        $canaimita      =   null;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        if( $fsoftware->load(Yii::$app->request->post()) ){
            $falla = $fsoftware->fsoft;
            $canaimita = $this->construirConsultar(new Fsoftware,'fsoft',$fsoftware->fsoft);
            $conteo = Fsoftware::find()->where(['fsoft'=>$fsoftware->fsoft])->count();
        }else
        if( $fpantalla->load(Yii::$app->request->post()) ){
            $falla = $fpantalla->fpant;
            $canaimita = $this->construirConsultar(new Fpantalla,'fpant',$fpantalla->fpant);
            $conteo = Fpantalla::find()->where(['fpant'=>$fpantalla->fpant])->count();
        }else
        if( $ftarjetamadre->load(Yii::$app->request->post()) ){
            $falla = $ftarjetamadre->ftarj;
            $canaimita = $this->construirConsultar(new Ftarjetamadre,'ftarj',$ftarjetamadre->ftarj);
            $conteo = Ftarjetamadre::find()->where(['ftarj'=>$ftarjetamadre->ftarj])->count();
        }else
        if( $fteclado->load(Yii::$app->request->post()) ){
            $falla = $fteclado->ftec;
            $canaimita = $this->construirConsultar(new Fteclado,'ftec',$fteclado->ftec);
            $conteo = Fteclado::find()->where(['ftec'=>$fteclado->ftec])->count();
        }else
        if( $fcarga->load(Yii::$app->request->post()) ){
            $falla = $fcarga->fcarg;
            $canaimita = $this->construirConsultar(new Fcarga,'fcarg',$fcarga->fcarg);
            $conteo = Fcarga::find()->where(['fcarg'=>$fcarga->fcarg])->count();
        }else
        if( $fgeneral->load(Yii::$app->request->post()) ){
            $falla = $fgeneral->fgen;
            $canaimita = $this->construirConsultar(new Fgeneral,'fgen',$fgeneral->fgen);
            $conteo = Fgeneral::find()->where(['fgen'=>$fgeneral->fgen])->count();
        }

        if ( $canaimita != false ) {
            $registros	= 6; // maximo de registros a mostrar en el PDF
            $incre		= 0;
            $control 	= 0;
            $contador	= (integer)$conteo; // variable de increment

            // API MPDF
            $pdf = Yii::$app->pdf;
            $mpdf = $pdf->api;


            foreach ($canaimita as $key => $value) {
                if ($incre == $registros) {
                    $vista = $this->renderPartial('_reportesFallas',[
                        'canaimita'=>$eq,
                        'falla'=>$falla
                    ]);
                    $mpdf->WriteHtml($vista);
                    unset($eq); // VACIA $eq PARA VOLVER A INICIALIZARLA
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
                    $mpdf->WriteHtml($vista);
                    unset($eq);
                }
            }
            echo $mpdf->Output('Reportes_de_Falla_'.$falla.'.pdf','D');
            Yii::$app()->session->setFlash('success','El reporte ha sido Creado');
            $this->refresh();
            die;
        }else {
            Yii::$app->session->setFlash('error',"Disculpe no existe data");
            $this->redirect(Url::toRoute('site/notfound'));
            //$this->redirect(Yii::$app->urlManager->createUrl('site/notfound') );
        }

        $this->render('reporte', [
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
		if ($modelo) {
			for ($i=0; $i < count($modelo); $i++) {
				$ideq[$i] = $modelo[$i]->ideq;
			}
			return Equipo::find()->where(['in','ideq',$ideq]);
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

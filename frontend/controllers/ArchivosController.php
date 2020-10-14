<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Formato;
use frontend\models\FormatoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
use yii\html\Url;

/**
 * ArchivosController implements the CRUD actions for Formato model.
 */
class ArchivosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','updatestatus','descargarfa'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','updatestatus','descargarfa'],
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
	*	@method updatestatus
	*	se actualiza el campo @var status de 'por ver' a 'visto'
	*/
	public function actionUpdatestatus(){
		$purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));

		if ( !empty($param) ) {
            $archivos = Formato::findOne($param);// obtiene el registro cuya clave primaria es $param
            $archivos->status = '1';
            if( $archivos->save(false) ) {
                return $this->render('view',['archivos'=>$archivos]);
            }else {
                $msj = "Ocurrio un error al marcar como visto el Archivo...";
                return $this->render('/site/notfound',['msj'=>$msj]);
                //throw new NotFoundHttpException("Ocurrio un error con la data...");
            }
		}else {
			return $this->redirect(['/canaimita/index']);
		}
	}

    /**
    *   @method Descargarfa
    *   Descarga el archivo del Campo Select
    *   Descarga el archivo del boton Download de GridView
    */
    public function actionDescargarfa()
    {
        if ( Yii::$app->request->isPost || Yii::$app->request->isGet ) {
            $purifier = new HtmlPurifier;
            $peticion = !empty(Yii::$app->request->post('FormatoSearch')) ?
                    Yii::$app->request->post('FormatoSearch')['idf'] :
                    Yii::$app->request->get('id');
            $valor = $purifier->process($peticion);
            $archivos = Formato::find()->where(['idf'=>$valor])->one();
            if (!$this->descargar($archivos->ruta, $archivos->nombf.'.'.$archivos->extens ,['ods','xls','odt','docx'])) {
                Yii::$app->session->setFlash('errormsj', "el archivo no se pudo descargar");
                $this->refresh();
            }
        }
    }

    /**
     * Lists all Formato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $actasArray = Formato::find()->asArray()->where(['opcion'=>'acta'])->andWhere(['statusacta'=>'1'])->all();
        $searchModel = new FormatoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actasArray'=>$actasArray
        ]);
    }

    /**
     * Displays a single Formato model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'archivos' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Formato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $archivos = new Formato;
        //Yii::$app->request->isPost

        if ( $archivos->load(Yii::$app->request->post()) ) {
            $archivos->ftutor = UploadedFile::getInstance($archivos,'ftutor');

            $archivos->nombf = $archivos->ftutor->baseName;
            $archivos->extens = $archivos->ftutor->extension;
            if ($archivos->statusacta == '1') {
                $archivos->ruta = 'archivos/fd/';
            }else {
                $archivos->ruta = 'archivos/';
            }
            $archivos->tamanio = $this->convert_format_bytes($archivos->ftutor->size);
            $archivos->status = '0';
            $archivos->create_at = date( "Y-m-d h:i:s",time() );
            $archivos->fkuser = Yii::$app->user->getId();

            if ( $archivos->ftutor && $archivos->validate() ) {
                if ($archivos->save()) {
                    $archivos->uploadArchivo();
                    return $this->redirect(['view', 'id' => $archivos->idf]);
                }else {
                    $msj = "Ocurrio un error al subir el Archivo...";
                    return $this->render('/site/notfound',['msj'=>$msj]);
                    //throw new NotFoundHttpException("Ocurrio un error con la data...");
                }
            }
        }

        return $this->render('create', [
            'archivos' => $archivos,
        ]);
    }

    /**
     * Updates an existing Formato model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $archivos = $this->findModel($id);

        /*if ($archivos->load(Yii::$app->request->post()) && $archivos->save()) {
            return $this->redirect(['view', 'id' => $archivos->idf]);
        }*/

        return $this->render('update', [
            'archivos' => $archivos,
        ]);
    }

    /**
     * Deletes an existing Formato model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionDelete($id)
	{
		$archivos = $this->findModel($id);
		$ruta = Yii::$app->request->baseUrl.$archivos->ruta;
		$archivo = $archivos->nombf;
		$filef = $this->eliminarArchivo($ruta,$archivo);
		if ($filef) {
			$archivos->delete();
            $this->redirect(Yii::$app->urlManager->createUrl('archivos/index'));
		}else {
            $this->redirect(Yii::$app->urlManager->createUrl('site/notfound'));
        }

	}

    /**
     * Finds the Formato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($archivos = Formato::findOne($id)) !== null) {
            return $archivos;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
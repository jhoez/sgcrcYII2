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
                'only' => ['index','create','update','view','delete','updatestatus','descargarfa'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','view','delete','updatestatus','descargarfa'],
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
	*	@method updatestatus
	*	se actualiza el campo @var status de 'por ver' a 'visto'
	*/
	public function actionUpdatestatus(){
		$purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));

		if ( !empty($param) ) {
            $archivos = Formato::findOne($param);// obtiene el registro cuya clave primaria es $param
            $archivos->status = true;
            if( $archivos->save(false) ) {
                return $this->redirect(['index']);
            }else {
                Yii::$app->session->setFlash('error','Ocurrio un error al marcar como visto el Archivo...');
                return $this->redirect(['index']);
            }
		}else {
			return $this->redirect(['index']);
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
            $param = !empty(Yii::$app->request->post('FormatoSearch')) ?
                    Yii::$app->request->post('FormatoSearch')['idf'] :
                    Yii::$app->request->get('id');
            $valor = $purifier->process($param);
            if ($valor !== "") {
                $archivos = Formato::find()->where(['idf'=>$valor])->one();
                if (!$this->descargar($archivos->ruta, $archivos->nombf.'.'.$archivos->extens ,['ods','xls','odt','docx'])) {
                    Yii::$app->session->setFlash('error','El archivo no se pudo descargar o no existe!!');
                    return $this->redirect(['/archivos/index']);
                }
            }else{
                Yii::$app->session->setFlash('error','Por favor seleccione un acta a descargar!!');
                return $this->redirect(['index']);
            }
        }
    }

    /**
     * Lists all Formato models.
     * @return mixed
     */
    public function actionIndex()
    {
        // arreglo de actas descargables
        $actasArray = Formato::find()->asArray()->where(['opcion'=>'acta'])->andWhere(['statusacta'=>true])->all();

        $searchModel = new FormatoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['statusacta'=>false]);

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
    public function actionView()
    {
        $purifier = new HtmlPurifier;
		$param = (int)$purifier->process(Yii::$app->request->get('id'));
        $archivos = $this->findModel($param);
        return $this->render('view',[
            'archivos' => $archivos,
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

        if ( $archivos->load(Yii::$app->request->post()) ) {
            $archivos->ftutor = UploadedFile::getInstance($archivos,'ftutor');

            $archivos->nombf = $archivos->ftutor->baseName;
            $archivos->extens = $archivos->ftutor->extension;
            if ($archivos->statusacta == true) {
                $archivos->ruta = 'archivos/fd/';
            }else {
                $archivos->ruta = 'archivos/';
            }
            $archivos->tamanio = $this->convert_format_bytes($archivos->ftutor->size);
            $archivos->status = false;
            $archivos->create_at = date( "Y-m-d h:i:s",time() );
            $archivos->fkuser = Yii::$app->user->getId();

            if ( $archivos->ftutor && $archivos->validate() ) {
                if ($archivos->save()) {
                    $archivos->uploadArchivo();
                    return $this->redirect(['view', 'id' => $archivos->idf]);
                }else {
                    Yii::$app->session->setFlash('error','Ocurrio un error al subir el Archivo...');
                    return $this->redirect(['index']);
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
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
		$param = (int)$purifier->process(Yii::$app->request->get('id'));
        $archivos = $this->findModel($param);

        if ( $archivos->load(Yii::$app->request->post()) ) {
            $archivos->ftutor = UploadedFile::getInstance($archivos,'ftutor');

			if ( $archivos->ftutor !== NULL ) {
				$filef = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$archivos->ruta,$archivos->nombf.'.'.$archivos->extens);

				if ($filef) {
					$archivos->nombf   = $archivos->ftutor->baseName;
					$archivos->extens  = $archivos->ftutor->extension;
					if (!empty($archivos->statusacta)) {
						$archivos->ruta		= 'archivos/fd/';
					}else {
						$archivos->ruta		= 'archivos/';
					}
					$archivos->tamanio	= $this->convert_format_bytes($archivos->ftutor->size);

					if( $archivos->save() ){
						$archivos->uploadArchivo();
						Yii::$app->session->setFlash('success','El formato fue Actualizado!!');
						return $this->redirect(['view', 'id' => $archivos->idf]);
					}else {//Crear mensaje flash
                        Yii::$app->session->setFlash('error','El formato no fue Actualizado');
                        return $this->redirect(['index']);
					}
				}
			}
        }

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
	public function actionDelete()
	{
        $purifier = new HtmlPurifier;
		$param = (int)$purifier->process(Yii::$app->request->get('id'));
		$archivos = $this->findModel($param);
		$result = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$archivos->ruta, $archivos->nombf.'.'.$archivos->extens);
		if ($result) {
			$archivos->delete();
            return $this->redirect(['index']);
		}else {
            Yii::$app->session->setFlash('error','El registro y archivo no se pudo eliminar!!');
            return $this->redirect(['index']);
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

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
 * FormatoController implements the CRUD actions for Formato model.
 */
class DescargablesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','updatestatus','descargarf'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','updatestatus','descargarf'],
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
    *   @method Descargarf
    *   Descarga el formato del Campo Select
    *   Descarga el formato del boton Download de GridView
    */
    public function actionDescargarf()
    {
        if ( Yii::$app->request->isPost || Yii::$app->request->isGet ) {
            $purifier = new HtmlPurifier;
            $peticion = !empty(Yii::$app->request->post('FormatoSearch')) ?
                    Yii::$app->request->post('FormatoSearch')['idf'] :
                    Yii::$app->request->get('id');
            $valor = $purifier->process($peticion);
            $formato = Formato::find()->where(['idf'=>$valor])->one();
            if (!$this->descargar($formato->ruta, $formato->nombf.'.'.$formato->extens ,['ods','xls','odt','docx'])) {
                Yii::$app->session->setFlash('errormsj', "el archivo no se pudo descargar");
                $this->refresh();
            }
        }
    }

    /**
	*	@method updatestatus
	*	se actualiza el campo @var status de formato a visto
	*/
	public function actionUpdatestatus($id){
		$purifier = new HtmlPurifier;
		$param = $purifier->process($_GET['id']);

		if ( !empty($param) ) {
            $formato = Formato::find()->where(['idf'=>$param])->one();
            $formato->status = true;
            if( $formato->save() ) {
                return $this->redirect(['view','id' => $formato->idf]);
            }else {
                $this->redirect(['site/notfound']);
            }
		}else {
			$this->redirect(['/canaimita/index']);
		}
	}

    /**
     * Lists all Formato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $actasArray = Formato::find()->asArray()->where(['opcion'=>'acta'])->andWhere(['statusacta'=>true])->all();
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
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Formato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $formato = new Formato;
        //Yii::$app->request->isPost

        if ( $formato->load(Yii::$app->request->post()) ) {
            $formato->ftutor = UploadedFile::getInstance($formato,'ftutor');

            $formato->nombf = $formato->ftutor->baseName;
            $formato->extens = $formato->ftutor->extension;
            if ($formato->statusacta == true) {
                $formato->ruta = 'formatos/fd/';
            }else {
                $formato->ruta = 'formatos/';
            }
            $formato->tamanio = $this->convert_format_bytes($formato->ftutor->size);
            $formato->status = false;
            $formato->create_at = date( "Y-m-d h:i:s",time() );

            if ( $formato->ftutor && $formato->validate() ) {
                if ($formato->save()) {
                    $formato->uploadArchivo();
                    return $this->redirect(['view', 'id' => $formato->idf]);
                }
            }
        }

        return $this->render('create', [
            'formato' => $formato,
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
        $model = $this->findModel($id);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idf]);
        }*/

        return $this->render('update', [
            'model' => $model,
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
		$formato = $this->findModel($id);
		$ruta = Yii::$app->request->baseUrl.$formato->ruta;
		$archivo = $formato->nombf;
		$filef = $this->eliminarArchivo($ruta,$archivo);
		if ($filef) {
			$formato->delete();
            $this->redirect(Yii::$app->urlManager->createUrl('descargables/index'));
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
        if (($model = Formato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

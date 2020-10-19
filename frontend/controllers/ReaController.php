<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Realaum;
use frontend\models\RealaumSearch;
use frontend\models\Proyecto;
use frontend\models\Imagen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\HtmlPurifier;

/**
 * RealaumController implements the CRUD actions for Realaum model.
 */
class ReaController extends Controller
{
    /**
     * {@inheritdoc}
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
     * permite descargar visualizar un libro
     * @param integer $param
     */
    public function actionRa()
    {
        $this->layout = "realidadaumentada";

        $purifier = new HtmlPurifier;
        $get = (int)$purifier->process( Yii::$app->request->get('param') );
        $realidadaumentada = Realaum::findOne($get);

        if( $realidadaumentada !== null )
        {
            return $this->render('plantillara',array(
                'realidadaumentada'=>$realidadaumentada,
            ));
        }else {
            $msj = "No existe el Archivo De realidad aumentada!!";
            return $this->redirect(['/site/notfound','msj'=>$msj]);
        }
    }

    /**
     * Lists all Realaum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $realidadaumentada = Realaum::find()->all();

        return $this->render('index', [
            'realidadaumentada' => $realidadaumentada,
        ]);
    }

    /**
     * Lists all Realaum models.
     * @return mixed
     */
    public function actionRegrea()
    {
        $searchModel = new RealaumSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('regrea', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Realaum model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'realidadaumentada' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Realaum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $proyecto			= new	Proyecto;
		$imag				= new	Imagen;
		$realidadaumentada	= new	Realaum;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($realidadaumentada);

		if(
            $proyecto->load(Yii::$app->request->post()) &&
            $realidadaumentada->load(Yii::$app->request->post()) &&
            $imag->load(Yii::$app->request->post())
        ){
			if (
                $proyecto->validate() &&
                $realidadaumentada->validate() &&
                $imag->validate()
            ){
    			$transaction = $realidadaumentada->db->beginTransaction();
                try{
    				$realidadaumentada->fileglb = UploadedFile::getInstance($realidadaumentada,'fileglb');// archivo pdf
    				$imag->imagen = UploadedFile::getInstance($imag,'imagen');// archivo imagen

    				$proyecto->create_at	= date( "Y-m-d h:i:s",time() );
    				$proyecto->fkuser		= Yii::$app->user->getId();
    				if( $proyecto->save() ){
    					$imag->nombimg		= $imag->imagen->baseName;
    					$imag->extension	= $imag->imagen->extension;
    					$imag->ruta			= "proyectos/raimg/";
    					$imag->tamanio		= $this->convert_format_bytes($imag->imagen->size);
    					$imag->tipoimg		= 'ra';

    					if ($imag->save()) {
    						$realidadaumentada->nra		= $realidadaumentada->fileglb->baseName;
    						$realidadaumentada->exten	= $realidadaumentada->fileglb->extension;
    						$realidadaumentada->ruta	= 'proyectos/ra/';
    						$realidadaumentada->idpro	= $proyecto->idpro;
    						$realidadaumentada->fkimag	= $imag->idimag;
    						if ( $realidadaumentada->save(false) ) {
                                //echo "<pre>";var_dump($realidadaumentada->save(false));die;
    							$realidadaumentada->uploadRa();
    							$imag->uploadImg();
    							Yii::$app->session->setFlash('raC','El proyecto de Realidad Aumentada fue Registrado');
    						}
    					}
    				}

    				$transaction->commit();
    				return $this->redirect(['view','id'=>$realidadaumentada->idra]);
    			} catch(ErrorException $e){
    				echo $e->getMessage();die;
    				$transaction->rollBack();
    				Yii::$app->session->setFlash('error','El proyecto de Realidad Aumentada no fue Registrado');
    				return $this->redirect( Url::toRoute(['site/notfound']) );// redirecciona a una vista cuando no sea exitoso el registro
    			}
            }
		}

		return $this->render('create',[
            'proyecto'=>$proyecto,
			'realidadaumentada'=>$realidadaumentada,
			'imag'=>$imag
		]);
    }

    /**
     * Updates an existing Realaum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idra]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Realaum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Realaum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Realaum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Realaum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

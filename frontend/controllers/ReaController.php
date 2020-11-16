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
    *   @method Descarga el patron de realidad aumentada
    */
    public function actionDescra()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('param') );
        $rea = Realaum::findOne($param);
        if (!$this->descargar($rea->ruta, $rea->nra.'.'.$rea->exten ,['glb'])) {
            Yii::$app->session->setFlash('error','No existe el patron de Realidad Aumentada!!');
            return $this->redirect(['index']);
        }
    }

    /**
     * permite visualizar
     * @param integer $param
     */
    public function actionRa()
    {
        $this->layout = "realidadaumentada";

        $purifier = new HtmlPurifier;
        $param = (int)$purifier->process( Yii::$app->request->get('param') );
        $realidadaumentada = Realaum::findOne($param);

        if( $realidadaumentada !== null )
        {
            return $this->render('plantillara',array(
                'realidadaumentada'=>$realidadaumentada,
            ));
        }else {
            Yii::$app->session->setFlash('error','No existe el Proyecto de Realidad Aumentada!!');
            return $this->redirect(['index']);
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
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process(Yii::$app->request->get('id'));
        $realidadaumentada = $this->findModel($param);
        return $this->render('view', [
            'realidadaumentada' => $realidadaumentada,
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
    						$realidadaumentada->fkpro	= $proyecto->idpro;
    						$realidadaumentada->fkimag	= $imag->idimag;
    						if ( $realidadaumentada->save(false) ) {
                                //echo "<pre>";var_dump($realidadaumentada->save(false));die;
    							$realidadaumentada->uploadRa();
    							$imag->uploadImg();
    							Yii::$app->session->setFlash('succes','El proyecto de Realidad Aumentada fue Registrado');
    						}
    					}
    				}

    				$transaction->commit();
    				return $this->redirect(['view','id'=>$realidadaumentada->idra]);
    			} catch(ErrorException $e){
    				echo $e->getMessage();die;
    				$transaction->rollBack();
    				Yii::$app->session->setFlash('error','El proyecto de Realidad Aumentada no fue Registrado');
    				return $this->redirect(['index']);// redirecciona a una vista cuando no sea exitoso el registro
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
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $realidadaumentada = $this->findModel($param);
        $proyecto = Proyecto::find()->where(['idpro'=>$realidadaumentada->fkpro])->one();
        $imag = Imagen::find()->where(['idimag'=>$realidadaumentada->fkimag])->one();

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

                    $delrea = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$realidadaumentada->ruta, $realidadaumentada->nra.'.'.$realidadaumentada->exten);
                    $delimg = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$imag->ruta, $imag->nombimg.'.'.$imag->extension);

                    if ($delrea && $delimg) {
                        $proyecto->update_at	= date( "Y-m-d h:i:s",time() );
        				$proyecto->fkuser		= Yii::$app->user->getId();
        				if( $proyecto->save() ){
        					$imag->nombimg		= $imag->imagen->baseName;
        					$imag->extension	= $imag->imagen->extension;
        					$imag->tamanio		= $this->convert_format_bytes($imag->imagen->size);

        					if ($imag->save()) {
        						$realidadaumentada->nra		= $realidadaumentada->fileglb->baseName;
        						$realidadaumentada->exten	= $realidadaumentada->fileglb->extension;
        						$realidadaumentada->fkpro	= $proyecto->idpro;
        						$realidadaumentada->fkimag	= $imag->idimag;
        						if ( $realidadaumentada->save(false) ) {
        							$realidadaumentada->uploadRa();
        							$imag->uploadImg();
        							Yii::$app->session->setFlash('succes','El proyecto de Realidad Aumentada fue Actualizado');
        						}
        					}
        				}
                    }else {
                        Yii::$app->session->setFlash('error','Los archivos de Realidad Aumentada no existen!!');
                        return $this->redirect(['index']);
                    }

    				$transaction->commit();
    				return $this->redirect(['view','id'=>$realidadaumentada->idra]);
    			} catch(ErrorException $e){
    				echo $e->getMessage();die;
    				$transaction->rollBack();
    				Yii::$app->session->setFlash('error','El proyecto de Realidad Aumentada no fue Actualizado');
    				return $this->redirect(['index']);// redirecciona a una vista cuando no sea exitoso el registro
    			}
            }
		}

        return $this->render('update', [
            'proyecto'=>$proyecto,
			'realidadaumentada'=>$realidadaumentada,
			'imag'=>$imag
        ]);
    }

    /**
     * Deletes an existing Realaum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );

        $realidadaumentada = $this->findModel($param);
        $proyecto = Proyecto::find()->where(['idpro'=>$realidadaumentada->fkpro])->one();
        $imagen = Imagen::find()->where(['idimag'=>$realidadaumentada->fkimag])->one();

        if ($realidadaumentada->delete()) {
            if ($proyecto->delete()) {
                if ($imagen->delete()) {
                    Yii::$app->session->setFlash('succes','El Proyecto de Realidad Aumentada fue Eliminado!!');
                    return $this->redirect(['index']);
                }
            }
        }

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

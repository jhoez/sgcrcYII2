<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Multimedia;
use frontend\models\MultimediaSearch;
use frontend\models\Proyecto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

/**
 * ProdigController implements the CRUD actions for Multimedia model.
 */
class ProdigController extends Controller
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
    public function actionDescva()
    {
        $purifier = new HtmlPurifier;
        $get = (integer)$purifier->process( Yii::$app->request->get('param') );
        $prodig = Multimedia::find()->where(['idmult'=>$get])->one();
        if( $prodig !== null )
        {
            return $this->redirect(Yii::$app->request->baseUrl.'/'.$prodig->ruta.$prodig->nombmult.'.'.$prodig->extension);
        }else {
            $msj = "No existe el Archivo multimedia!!";
            return $this->render('/site/notfound',['msj'=>$msj]);
        }
    }

    /**
     * Lists all Multimedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $prodig = Multimedia::find()->all();

        return $this->render('index', [
            'prodig' => $prodig
        ]);
    }

    /**
     * Lists all Multimedia models.
     * @return mixed
     */
    public function actionRegistros()
    {
        $searchModel = new MultimediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('registros', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Multimedia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'multimedia' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Multimedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $proyecto = new Proyecto;
		$multimedia = new Multimedia;

        if (
            $proyecto->load(Yii::$app->request->post()) &&
            $multimedia->load(Yii::$app->request->post())
        ) {
            if (
                $proyecto->validate() &&
                $multimedia->validate()
            ) {
                $transaction = $proyecto->db->beginTransaction();
                try{
    				$multimedia->mva = UploadedFile::getInstance($multimedia,'mva');// archivo multimedia

    				$proyecto->create_at	= date( "Y-m-d h:i:s",time() );
                    $proyecto->update_at	= date( "Y-m-d h:i:s",time() );
    				$proyecto->fkuser		= Yii::$app->user->getId();

    				if($proyecto->save()){
    					$multimedia->nombmult	= $multimedia->mva->baseName;
    					$multimedia->extension	= $multimedia->mva->extension;
    					$multimedia->tamanio	= $this->convert_format_bytes( $multimedia->mva->size );
    					if ($multimedia->extension == 'mp4') {
    						$multimedia->tipomult	= 'video';
    						$multimedia->ruta		= 'proyectos/video/';
    					}elseif ($multimedia->extension == 'mp3') {
    						$multimedia->tipomult	= 'audio';
    						$multimedia->ruta		= 'proyectos/audio/';
    					}
    					$multimedia->fkpro = $proyecto->idpro;

    					if (
    						$multimedia->extension == 'mp4' ||
    						$multimedia->extension == 'mp3'
    					) {
    						if ($multimedia->save()){
    							$multimedia->uploadMultimedia();
    							Yii::$app->session->setFlash('multimediaC',"El Proyecto '$proyecto->nombpro' a sido Registrado");
    						}
    					}
    				}

    				$transaction->commit();
    				return $this->render('view',['multimedia'=>$multimedia]);
    			} catch(ErrorException $e){
    				$transaction->rollBack();
                    //echo "<pre>".$e;die;
    				Yii::$app->session->setFlash('error','El proyecto Digital no fue Registrado');
    				return $this->redirect( Url::toRoute(['site/notfound']) );// redirecciona a una vista cuando no sea exitoso el registro
    			}
            }// validate
        }// post

        return $this->render('create', [
            'proyecto'	=> $proyecto,
			'multimedia'=> $multimedia
        ]);
    }

    /**
     * Updates an existing Multimedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idmult]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Multimedia model.
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
     * Finds the Multimedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Multimedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Multimedia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

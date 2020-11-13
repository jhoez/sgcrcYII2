<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Libros;
use frontend\models\LibrosSearch;
use frontend\models\Imagen;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;

/**
 * ConteducController implements the CRUD actions for Libros model.
 */
class ConteducController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','view','delete','verlib','desclib','registros'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','view','delete','verlib','desclib','registros'],
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
     * permite descargar visualizar un libro
     * @param integer $param
     */
    public function actionVerlib()
    {
        $purifier = new HtmlPurifier;
        $get = (integer)$purifier->process( Yii::$app->request->get('id') || Yii::$app->request->get('param') );
        $contenido = Libros::findOne($get);
        return $this->render('libro',[
            'contenido'=>$contenido
        ]);
    }

    /**
     * permite descargar un libro
     * @param integer $param
     */
    public function actionDesclib()
    {
        $purifier = new HtmlPurifier;
        $get = $purifier->process( Yii::$app->request->get('param') );
        $contenido = Libros::findOne($get);
        if (!$this->descargar($contenido->ruta, $contenido->nomblib.'.'.$contenido->extension ,['pdf'])) {
            $msj = "No existe el Libro!!";
            return $this->render('/site/notfound',['msj'=>$msj]);
        }
    }

    /**
     * Lists all Libros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $contenido = Libros::find()->all();

        return $this->render('index', [
            'contenido'=>$contenido
        ]);
    }

    /**
     * Lists all Libros registrados.
     * @return mixed
     */
    public function actionRegistros()
    {
        $searchModel = new LibrosSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('registros', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libros model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $contenido = $this->findModel($param);
        return $this->render('view', [
            'contenido' => $contenido,
        ]);
    }

    /**
     * Creates a new Libros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $contenido = new Libros;
        $img = new Imagen;

        if (
            $contenido->load(Yii::$app->request->post()) &&
            $img->load(Yii::$app->request->post())
        ) {
            if (
                $img->validate() &&
                $contenido->validate()
            ) {
                $contenido->files = UploadedFile::getInstance($contenido,'files');
                $img->imagen = UploadedFile::getInstance($img,'imagen');

                $img->nombimg	= $img->imagen->baseName;
                $img->extension = $img->imagen->extension;
                $img->ruta		= "coleccionLibros/cimg/";
                $img->tamanio	= $this->convert_format_bytes($img->imagen->size);
                $img->fkuser	= Yii::$app->user->getId();

                if ( $img->imagen !== null ) {
                    if ( $img->save() ) {
                        $contenido->nomblib	= $contenido->files->baseName;
                        $contenido->extension	= $contenido->files->extension;

                        $coleccion	= $contenido->coleccion;
                        $niv		= $contenido->nivel;
                        if ($coleccion == 'coleccionBicentenaria') {
                            $contenido->ruta = "coleccionLibros/$coleccion/$niv/";
                        }elseif( $coleccion == ('coleccionMaestros' || 'lectura') ){
                            $contenido->ruta = "coleccionLibros/$coleccion/";
                        }

                        if ($niv == ('inicial' || 'primaria' || 'media')) {
                            $contenido->nivel	= $niv;
                        }else if($coleccion == 'coleccionMaestros'){
                            $contenido->nivel	=  'maestro';
                        }else if($coleccion == 'lectura') {
                            $contenido->nivel = 'lectura';
                        }

                        $contenido->tamanio	= $this->convert_format_bytes($contenido->files->size);
                        $contenido->fkimag = $img->idimag;

                        if ( $contenido->files !== null ) {
                            if ( $contenido->save() ) {
                                $img->uploadImg();//Guardamos el fichero
                                $contenido->uploadArchivo();//Guardamos el fichero
                                Yii::$app->session->setFlash('success','El Contenido Educativo fue Registrado!!');
                                return $this->redirect(['view', 'id' => $contenido->idlib]);
                            }else {
                                Yii::$app->session->setFlash('error','No se logro registrar el Contenido Educativo!!');
                                return $this->redirect(['index']);
                            }
                        }
                    }// save img
                }
            }// validate
        }// carga post

        return $this->render('create', [
            'contenido' => $contenido,
            'img'=>$img
        ]);
    }

    /**
     * Updates an existing Libros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $contenido = Libros::findOne($param);
        $img = Imagen::findOne($contenido->fkimag);

        if (
            $contenido->load(Yii::$app->request->post()) &&
            $img->load(Yii::$app->request->post())
        ) {
            $transaction = $contenido->db->beginTransaction();
            try {
                $contenido->files = UploadedFile::getInstance($contenido,'files');
                $img->imagen = UploadedFile::getInstance($img,'imagen');
                // eliminarArchivo DEVUELVE true O false SI ELIMINA O NO LA PORTADA Y EL LIBRO
                $librof = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$contenido->ruta, $contenido->nomblib.'.'.$contenido->extension);
                $imagenf = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$img->ruta, $img->nombimg.'.'.$img->extension);

                if ($librof && $imagenf) {
                    $img->nombimg	= $img->imagen->baseName;
                    $img->extension = $img->imagen->extension;
                    $img->ruta		= "coleccionLibros/cimg/";
                    $img->tamanio	= $this->convert_format_bytes($img->imagen->size);
                    $img->fkuser	= Yii::$app->user->getId();

                    if ( $img->imagen && $img->validate() ) {
                        if ( $img->save() ) {
                            $contenido->nomblib	= $contenido->files->baseName;
                            $contenido->extension	= $contenido->files->extension;

                            $coleccion	= $contenido->coleccion;
                            $niv		= $contenido->nivel;
                            if ($coleccion == 'coleccionBicentenaria') {
                                $contenido->ruta = "coleccionLibros/$coleccion/$niv/";
                            }elseif( $coleccion == ('coleccionMaestros' || 'lectura') ){
                                $contenido->ruta = "coleccionLibros/$coleccion/";
                            }

                            if ($niv == ('inicial' || 'primaria' || 'media')) {
                                $contenido->nivel	= $niv;
                            }else if($coleccion == 'coleccionMaestros'){
                                $contenido->nivel	=  'maestro';
                            }else if($coleccion == 'lectura') {
                                $contenido->nivel = 'lectura';
                            }

                            $contenido->tamanio	= $this->convert_format_bytes($contenido->files->size);
                            $contenido->fkimag = $img->idimag;

                            if ( $contenido->files && $contenido->validate() ) {
                                if ( $contenido->save() ) {
                                    $img->uploadImg();//Guardamos el fichero
                                    $contenido->uploadArchivo();//Guardamos el fichero
                                    Yii::$app->session->setFlash('error','El Contenido Educativo fue Actualizado!!');
                                }
                            }
                        }// save IMG
                    }// validate
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $contenido->idlib]);
                }else {
                    Yii::$app->session->setFlash('error','No se pudo actualizar el Contenido Educativo!!');
                    return $this->redirect(['index']);
                }

            } catch (ErrorException $e) {
                //echo "<pre>";var_dump($e);die;
                $transaction->rollBack();
                Yii::$app->session->setFlash('error','No se pudo actualizar el Contenido Educativo!!');
                return $this->redirect(['index']);
            }
        }// carga post

        return $this->render('update', [
            'contenido' => $contenido,
            'img'=>$img
        ]);
    }

    /**
     * Deletes an existing Libros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier   = new HtmlPurifier;
        $param      = $purifier->process( Yii::$app->request->get('id') );
        $libros		= $this->findModel($param);
		$imag		= Imagen::find()->where(['idimag'=>$libros->fkimag])->one();

		$librof		= $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$libros->ruta, $libros->nomblib.'.'.$libros->extension);
		$imagenf	= $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$imag->ruta, $imag->nombimg.'.'.$imag->extension);

        if ($librof && $imagenf) {
			$libros->delete();
			$imag->delete();
            Yii::$app->session->setFlash('succes','Se eliminado el Contenido Educativo!!');
            return $this->redirect(['index']);
		}else {
            Yii::$app->session->setFlash('error','No existe el Contenido Educativo a eliminar!!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Libros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Libros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

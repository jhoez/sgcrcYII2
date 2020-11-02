<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Libros;
use frontend\models\Imagen;
use frontend\models\LibrosSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
    public function actionVerlib()
    {
        $purifier = new HtmlPurifier;
        $get = (integer)$purifier->process( Yii::$app->request->get('id') || Yii::$app->request->get('param') );
        $contenido = Libros::findOne($get);
        return $this->redirect(Yii::$app->request->baseUrl.'/'.$contenido->ruta.$contenido->nomblib.'.'.$contenido->extension);
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            $contenido->files = UploadedFile::getInstance($contenido,'files');
            $img->imagen = UploadedFile::getInstance($img,'imagen');

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
                            //Yii::$app->session->setFlash('libroC',"El Libro '$contenido->nomblib' a sido Registrado");
                        }
                    }
                }// save
            }// validate

            return $this->redirect(['view', 'id' => $contenido->idlib]);
            //return $this->render('/site/notfound',['msj'=>$msj]);

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
                                    //Yii::$app->session->setFlash('libroC',"El Libro '$contenido->nomblib' a sido Registrado");
                                }
                            }
                        }// save IMG
                    }// validate
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $contenido->idlib]);
                }else {
                    $msj = 'No se pudo actualizar el libro!!';
                    return $this->redirect(['/site/notfound','msj'=>$msj]);
                }

            } catch (ErrorException $e) {
                echo "<pre>";var_dump($e);die;
                $transaction->rollBack();
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
        $libros		= $this->findModel($id);
		$imag		= Imagen::find()->where(['idimag'=>$libros->fkimag])->one();

		$rutalibro	= Yii::$app->basePath.'/web/'.$libros->ruta;
		$filelib	= $libros->nomblib.$libros->extension;
		$rutaimagen	= Yii::$app->basePath.'/web/'.$imag->ruta;
		$fileimg	= $imag->nombimg.$imag->extension;

		$librof		= $this->eliminarArchivo($rutalibro, $filelib);
		$imagenf	= $this->eliminarArchivo($rutaimagen, $fileimg);
		if ($librof && $imagenf) {
			$libros->delete();
			$imag->delete();
            return $this->redirect(['index']);
		}else {
            $msj = 'No se logro eliminar el libro!!';
            return $this->redirect(['/site/notfound','msj'=>$msj]);
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

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
        $get = $purifier->process( Yii::$app->request->get('param') );
        $contenido = Libros::findOne($get);
        return $this->redirect(Yii::$app->request->baseUrl.'/'.$contenido->ruta.$contenido->nomblib.'.'.$contenido->extension);
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
                    $contenido->idfkimag = $img->idimag;

                    if ( $contenido->files && $contenido->validate() ) {
                        if ( $contenido->save() ) {
                            $img->uploadArchivo();//Guardamos el fichero
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idlib]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libros model.
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

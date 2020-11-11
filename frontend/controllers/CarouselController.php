<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Imagen;
use frontend\models\ImagenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\HtmlPurifier;

/**
 * ImgController implements the CRUD actions for Imagen model.
 */
class CarouselController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Imagen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagenSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['tipoimg'=>'noticia']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
		$param = (int)$purifier->process(Yii::$app->request->get('id'));
        $carousel = $this->findModel($param);
        return $this->render('view', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * Creates a new Imagen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $carousel = new Imagen;

        if ($carousel->load(Yii::$app->request->post())) {
            if ($carousel->validate()) {
                $carousel->imagen = UploadedFile::getInstance($carousel,'imagen');
                $carousel->nombimg = $carousel->imagen->baseName;
                $carousel->extension = $carousel->imagen->extension;
                $carousel->ruta = 'proyectos/img/';
                $carousel->tamanio = $this->convert_format_bytes($carousel->imagen->size);
                $carousel->tipoimg = 'noticia';
                $carousel->fkuser = Yii::$app->user->getId();
                if ( $carousel->save() ) {
                    $carousel->uploadImg();
                    return $this->redirect(['view', 'id' => $carousel->idimag]);
                }
            }
        }

        return $this->render('create', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * Updates an existing Imagen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));
        $carousel = $this->findModel($param);

        if ($carousel->load(Yii::$app->request->post())) {
            if ($carousel->validate()) {
                $carousel->imagen = UploadedFile::getInstance($carousel,'imagen');
                if ( !is_null($carousel->imagen) ) {
                    $imgupdate = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$carousel->ruta,$carousel->nombimg.'.'.$carousel->extension);
                    if ($imgupdate) {
                        $carousel->nombimg = $carousel->imagen->baseName;
                        $carousel->extension = $carousel->imagen->extension;
                        $carousel->ruta = 'proyectos/img/';
                        $carousel->tamanio = $this->convert_format_bytes($carousel->imagen->size);
                        $carousel->tipoimg = 'noticia';
                        $carousel->fkuser = Yii::$app->user->getId();
                        if ( $carousel->save() ) {
                            $carousel->uploadImg();
                            return $this->redirect(['view', 'id' => $carousel->idimag]);
                        }
                    }
                }
            }
        }

        return $this->render('update', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * Deletes an existing Imagen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );
        $carousel = $this->findModel($param);
        $imgdelete = $this->eliminarArchivo(Yii::$app->basePath.'/web/'.$carousel->ruta,$carousel->nombimg.'.'.$carousel->extension);
        if ($imgdelete) {
            $carousel->delete();
            Yii::$app->session->setFlash('success','Registro e imagen eliminados con exito!!');
            return $this->redirect(['index']);
        }else {
            Yii::$app->session->setFlash('error','No existe el registro e imagen a eliminar!!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Imagen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Imagen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Imagen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

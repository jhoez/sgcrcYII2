<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Estado;
use frontend\models\Municipio;
use frontend\models\Parroquia;
use frontend\models\Sedeciat;
use frontend\models\Insteduc;
use frontend\models\Representante;
use frontend\models\Direcuser;
use frontend\models\Estudiante;
use frontend\models\Niveleduc;
use frontend\models\Equipo;
use frontend\models\EquipoSearch;
use frontend\models\Fsoftware;
use frontend\models\Fpantalla;
use frontend\models\Ftarjetamadre;
use frontend\models\Fteclado;
use frontend\models\Fcarga;
use frontend\models\Fgeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class CanaimitaController extends Controller
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
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EquipoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipo model.
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
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $estado         =   new     Estado;
        $municipio      =   new     Municipio;
        $parroquia      =   new     Parroquia;
        $estadoArray    =   Estado::find()->asArray()->all();
        $municipioArray =   Municipio::find()->asArray()->all();
        $parroquiaArray =   Parroquia::find()->asArray()->all();
        $sedeciat       =   new     Sedeciat;
        $insteduc       =   new     Insteduc;
        $representante  =   new     Representante;
        $direcuser      =   new     Direcuser;
        $estudiante     =   new     Estudiante;
        $niveleduc      =   new     Niveleduc;
        $equipo         =   new     Equipo;
        $fsoftware      =   new     Fsoftware;
        $fpantalla      =   new     Fpantalla;
        $ftarjetamadre  =   new     Ftarjetamadre;
        $fteclado       =   new     Fteclado;
        $fcarga         =   new     Fcarga;
        $fgeneral       =   new     Fgeneral;

        if (
            $estado->load(Yii::$app->request->post()) &&
            $municipio->load(Yii::$app->request->post()) &&
            $parroquia->load(Yii::$app->request->post()) &&
            $sedeciat->load(Yii::$app->request->post()) &&
            $insteduc->load(Yii::$app->request->post()) &&
            $representante->load(Yii::$app->request->post()) &&
            $direcuser->load(Yii::$app->request->post()) &&
            $estudiante->load(Yii::$app->request->post()) &&
            $niveleduc->load(Yii::$app->request->post()) &&
            $equipo->load(Yii::$app->request->post()) &&
            $fsoftware->load(Yii::$app->request->post()) &&
            $fpantalla->load(Yii::$app->request->post()) &&
            $ftarjetamadre->load(Yii::$app->request->post()) &&
            $fteclado->load(Yii::$app->request->post()) &&
            $fcarga->load(Yii::$app->request->post()) &&
            $fgeneral->load(Yii::$app->request->post())
        ) {
            if (
                $estado->validate() &&
                $municipio->validate() &&
                $parroquia->validate() &&
                $sedeciat->validate() &&
                $insteduc->validate() &&
                $representante->validate() &&
                $direcuser->validate() &&
                $estudiante->validate() &&
                $niveleduc->validate() &&
                $equipo->validate() &&
                $fsoftware->validate() &&
                $fpantalla->validate() &&
                $ftarjetamadre->validate() &&
                $fteclado->validate() &&
                $fcarga->validate() &&
                $fgeneral->validate()
            ) {
                //$transaction = Yii::$app->db->beginTransaction();

                $equipo->save();
                return $this->redirect(['view', 'id' => $equipo->ideq]);
            }
        }

        return $this->render('create', [
            'estado'        =>  $estado,
            'municipio'     =>  $municipio,
            'parroquia'     =>  $parroquia,
            'estadoArray'        =>  $estadoArray,
            'municipioArray'     =>  $municipioArray,
            'parroquiaArray'     =>  $parroquiaArray,
            'sedeciat'      =>  $sedeciat,
            'insteduc'      =>  $insteduc,
            'representante' =>  $representante,
            'estudiante'    =>  $estudiante,
            'niveleduc'     =>  $niveleduc,
            'equipo'        =>  $equipo,
            'fsoftware'     =>  $fsoftware,
            'fpantalla'     =>  $fpantalla,
            'ftarjetamadre' =>  $ftarjetamadre,
            'fteclado'      =>  $fteclado,
            'fcarga'        =>  $fcarga,
            'fgeneral'      =>  $fgeneral,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ideq]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Equipo model.
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
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    *   @method
    *
    */
    public function actionMuncall()
    {
    }

    /**
    *   @method
    *
    */
    public function actionParrall()
    {
    }

    /**
    *   @method
    *
    */
    public function actionReportespdf()
    {
        return $this->render('reportes');
    }

    /**
    *   @method
    *
    */
    public function actionReportesfallas()
    {
    }

    public function contruirConsultaFallas($clase,$index,$falla)
    {
    }

    /**
    *   @method
    *
    */
    public function actionMarcarentregado()
    {
    }

}

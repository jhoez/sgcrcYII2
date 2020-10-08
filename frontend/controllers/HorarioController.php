<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Asistencia;
use frontend\models\AsistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;

/**
 * AsistenciaController implements the CRUD actions for Asistencia model.
 */
class HorarioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','reporteasistencia','reportemes','marcarsalida'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','reporteasistencia','reportemes','marcarsalida'],
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
     * Lists all Asistencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsistenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asistencia model.
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
     * Creates a new Asistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $horario = new Asistencia;
        $purifier = new HtmlPurifier;
        $horaE  = '05:30:00';
        $lhoraE = '05:31:00';
        $horaS  = '05:31:30';
        $lhoraS = '05:35:00';

        if ( $horario->load(Yii::$app->request->post()) ) {
            if ( $horario->validate() ) {
                $paramget = isset($_GET['ms']) ? $purifier->process($_GET['ms']) : null;
                if ($paramget == null) {
                    $horario->fkuser = Yii::$app->user->getId();
                    $horario->fecha = date("Y-m-d",time());

                    if ( $horario->save() ) {
                        return $this->redirect(['view', 'id' => $horario->idasis]);
                    }
                }else {
                    $fecha	= date("Y-m-d",time());
                    $asistencia = Asistencia::find()
                                ->where(['fecha'=>$fecha])
                                ->andWhere(['fkuser'=>Yii::$app->user->getId()])
                                ->one();
                    if ( $asistencia !== null ) {
                        $asistencia->horaout = $horario->horaout;
                        $asistencia->observacion = $horario->observacion;
                        if ( $asistencia->save() ) {
                            //$horario = $asistencia;
                            return $this->redirect(['view', 'id' => $asistencia->idasis]);
                        }
                    }else {
                        $horario->fkuser = Yii::$app->user->getId();
                        if ( $horario->save() ) {
                            return $this->redirect(['view', 'id' => $horario->idasis]);
                        }
                    }
                }
            }
        }

        return $this->render('create', [
            'horario'   => $horario,
            'horaE'     => $horaE,
            'horaS'     => $horaS,
            'lhoraE'    => $lhoraE,
            'lhoraS'    => $lhoraS
        ]);
    }

    /**
     * Updates an existing Asistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idasis]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asistencia model.
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
     * Finds the Asistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asistencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

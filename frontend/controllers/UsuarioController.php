<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use yii\helpers\HtmlPurifier;
use frontend\models\Usuario;
use frontend\models\UsuarioSearch;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $usuario = $this->findModel($param);
        return $this->render('view', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $usuario = new Usuario;

        if ($usuario->load(Yii::$app->request->post())) {
            $usuario->generateAuthKey();
            $usuario->generatePasswordResetToken();
            $usuario->status=1;
            $usuario->created_at=date( "Y-m-d h:i:s",time() );
            //$usuario->updated_at=date( "Y-m-d h:i:s",time() );
            $usuario->generateEmailVerificationToken();
            if ($usuario->save()) {
                // se asigna por defecto el role tutor al usuario creado.
                //$auth = Yii::$app->authManager;
                //$tutorRole = $auth->getRole('tutor');
                //$auth->assign($tutorRole, $usuario->getId());
                Yii::$app->session->setFlash('succes','El usuario fue registrado!!');
                return $this->redirect(['view', 'id' => $usuario->id]);
            } else {
                Yii::$app->session->setFlash('error','El usuario no fue registrado!!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $usuario = $this->findModel($param);

        if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
            return $this->redirect(['view', 'id' => $usuario->iduser]);
        }

        return $this->render('update', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $usuario = $this->findModel($param);

        if ($usuario->delete()) {
            Yii::$app->session->setFlash('success','El usuario fue Eliminado!!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

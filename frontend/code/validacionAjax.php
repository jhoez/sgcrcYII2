<?php
// ESTO VA EN EL FORMULARIO
$form = ActiveForm::begin([
    'id'=>'formulario',
    'enableClientValidation'=>true,
    'enableAjaxValidation' => true,
]);
// ESTO VA ANTES DE LA CARGA COMPLETA DEL FORMULARIO
if ($sedeciat->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
    Yii::$app->response->format = Response::FORMAT_JSON;
    Yii::$app->session->setFlash('error', "La Sede $sedeciat->sede ya existe...");
    //$this->refresh();
    return ActiveForm::validate($sedeciat);
}

//esto va en el metodo rule del modelo
['campoDeMiTabla','metodoDeValidacionAjax']

//luego se crea el metodo de Validacion Ajax
public function metodoDeValidacionAjax($attribute,$params)
{
    //SE CREA LA LOGICA QUE SE NECESITE
    //SE AÑADE EL ERROR AL CAMPO DEL FORMULARIO
    if ($attribute) {
        $this->addError($attribute,'MENSAJE DE ERROR');
    }
}

?>

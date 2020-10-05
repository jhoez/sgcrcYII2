<?php

El primer paso será decidir cuales serán los campos que están en las otras tablas ya que necesitaremos hacer lo siguiente:

Paso #1.

Agrega parámetros públicos de tus variables de los cuales deseas realizar la búsqueda, puedes agregar cuantas relaciones tengas con otras tablas, el único requisito es que exista una relación de modelo entre las tablas que vas a utilizar.

public $username;


Paso #2.

Agregar los saltos o joins a las tablas que se desea relaciónar, recuerda que debes usar los nombres de relación que están declarados dentro del modelo de la tabla principal, por ejemplo en este caso mi tabla principal es "DispositivoLogin" por lo que debo de buscar el nombre de la relación que está declarada en el modelo que en mi caso se llama "accessToken".


public function search($params)

   {

       $query = DispositivoLogin::find()
                ->joinWith(['accessToken'])
                ->joinWith(['accessToken.usuario']);

Observa que para el tercer salto, estoy utilizando una combinación entre 2 nombres de relación;  "->joinWith(['accessToken.usuario']);"


Paso #3.

En la sección del método rules, agregar el mismo nombre del método público.



public function rules()

   {

       return [

           [['id', 'access_token_id'], 'integer'],

           [['fecha_login' , 'username'], 'safe'],

       ];

   }


Paso #4.

Agregar en la sección de filtros el where como el siguiente ejemplo:


$query->andFilterWhere(['like', 'username', $this->username]);

En este caso como se observa se escribe el nombre del salto y como segundo parámetro el nombre del método público de la clase search.


Paso #5.

Para que se pueda mostrar el campo en la tabla "Gridview" deberás de agregar el campo de la siguiente manera.

       'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           'id',
           [
               'attribute' => 'username',
               'value' => 'accessToken.usuario.username'
           ],
      ]
Paso #6
Si deseas agregar más campos puedes agregar más parámetros y repetir el proceso de la misma manera cómo lo menciona desde el paso #1.

?>

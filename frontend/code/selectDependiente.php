<div class="form-group">
    <label for="curl" class="control-label col-lg-2">Marca</label>
    <div class="col-lg-4">
        <?= $form->field($model, 'marca',['inputOptions'=>[ 'class'=>'form-control', 'placeholder' => 'tipo'] ] )->dropDownList(
            ArrayHelper::map(CatMarca::find()->orderBy(['id'=>SORT_ASC])->all(),'id','nombre'),
            [
                'prompt'=>Yii::t('app', '--- Selecciona Marca ---'),
                'onchange'=>
                    '$.post(
                        "'.Yii::$app->urlManager->createUrl('soporte/inv-equipos/modelos?id=').'"+$(this).val(),
                        function( data ) {
                            $( "select#invequipos-modelo" ).html( data );
                        }
                    );'
            ])->label(false);
        ?>
    </div>
</div>
<div class="form-group">
    <label for="ccomment" class="control-label col-lg-1">Modelo</label>
    <div class="col-lg-4">
        <?= $form->field($model, 'modelo', ['inputOptions'=>[ 'class'=>'form-control', 'placeholder' => 'modelo'] ] )->dropDownList(
            ArrayHelper::map(CatModelo::find()->orderBy(['id'=>SORT_ASC])->all(),'id','modelo'),
            ['prompt'=>Yii::t('app', '--- Selecciona modelo ---')]
            )->label(false);
        ?>
    </div>
</div>

<?php
//----Action----
   public function actionModelos($id)
    {
        $cuentaModelos = CatModelo::find()->where(['id'=>$id])->count();
        $modelos = CatModelo::find()->where(['id'=>$id])->all();

        if ($cuentaModelos > 0) {
            foreach ($modelos as $key => $value) {
                echo "<option value=". $value->id . ">". $value->modelo. "</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

?>

<?= Html::dropDownList(
    's_id', null,
    ArrayHelper::map(InvEmpleados::find()->all(), 'id', 'nombre'),
    [
        'onchange'=>
            '$.post( "'.Yii::$app->urlManager->createUrl('empresa/saldos/movs?emp=').'"+$(this).val(),
                function(data){
                    $("#test_div").html( data );
                }
            )'
    ]
)?>

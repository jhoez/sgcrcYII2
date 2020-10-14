<div class="">
    <?php
    //Yii::$app->controller->renderPartial
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Canaimitas',
                'content' => $this->render('_viewc',[
                    'cdataProvider'=>$cdataProvider,
                    'csearchModel'=>$csearchModel
                ]),
                //'active' => true,
                'headerOptions' => ['role'=>'presentation'],// tag li
                'options' => ['id' => 'canaimitas','data-toggle'=>'tab'],//tag a
            ],
            [
                'label' => 'Formatos',
                'content' => Yii::$app->controller->renderPartial('_viewf',[
                    'fdataProvider'=>$fdataProvider,
                    'fsearchModel'=>$fsearchModel,
                    'actasArray'=>$actasArray
                ]),
                'headerOptions' => ['role'=>'presentation'],// tag li
                'options' => ['id' => 'formatos'],//tag a
                'itemOptions' => ['tag' => 'div'],
            ],
        ],
        //'options' => ['tag' => 'div'],
        //'itemOptions' => ['tag' => 'div'],
        'options'=>['class'=>'nav nav-pills'],
        //'clientOptions' => ['collapsible' => false],
    ]);
    ?>
</div>

<?php
'modules' => [
    'gridview' => [
        'class' => 'kartik\grid\Module',
        // other module settings
    ]
]

//Usage ExportMenu

use kartik\export\ExportMenu;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'id',
    'name',
    'color',
    'publish_date',
    'status',
    ['class' => 'yii\grid\ActionColumn'],
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]);

?>

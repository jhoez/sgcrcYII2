<?php

// export data only one worksheet.

\moonland\phpexcel\Excel::widget([
	'models' => $allModels,
	'mode' => 'export', //default value as 'export'
	'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label. 
	'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
]);

\moonland\phpexcel\Excel::export([
	'models' => $allModels, 
	'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label. 
	'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
]);

// export data with multiple worksheet.

\moonland\phpexcel\Excel::widget([
	'isMultipleSheet' => true, 
	'models' => [
		'sheet1' => $allModels1, 
		'sheet2' => $allModels2, 
		'sheet3' => $allModels3
	], 
	'mode' => 'export', //default value as 'export' 
	'columns' => [
		'sheet1' => ['column1','column2','column3'], 
		'sheet2' => ['column1','column2','column3'], 
		'sheet3' => ['column1','column2','column3']
	],
	//without header working, because the header will be get label from attribute label. 
	'header' => [
		'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
		'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
		'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
	],
]);

\moonland\phpexcel\Excel::export([
	'isMultipleSheet' => true, 
	'models' => [
		'sheet1' => $allModels1, 
		'sheet2' => $allModels2, 
		'sheet3' => $allModels3
	], 'columns' => [
		'sheet1' => ['column1','column2','column3'], 
		'sheet2' => ['column1','column2','column3'], 
		'sheet3' => ['column1','column2','column3']
	], 
	//without header working, because the header will be get label from attribute label. 
	'header' => [
		'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
		'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
		'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
	],
]);


//////////////////////////////////////////////////////////////////////////////


//New Feature for exporting data,
//you can use this if you familiar yii gridview.
//That is same with gridview data column.
//Columns in array mode valid params are 'attribute', 'header', 'format', 'value', and footer (TODO).
//Columns in string mode valid layout are 'attribute:format:header:footer(TODO)'.
  
\moonland\phpexcel\Excel::export([
   	'models' => Post::find()->all(),
      	'columns' => [
      		'author.name:text:Author Name',
      		[
      				'attribute' => 'content',
      				'header' => 'Content Post',
      				'format' => 'text',
      				'value' => function($model) {
      					return ExampleClass::removeText('example', $model->content);
      				},
      		],
      		'like_it:text:Reader like this content',
      		'created_at:datetime',
      		[
      				'attribute' => 'updated_at',
      				'format' => 'date',
      		],
      	],
      	'headers' => [
     		'created_at' => 'Date Created Content',
		],
]);


//Import file excel and return into an array.

$data = \moonland\phpexcel\Excel::import($fileName, $config); // $config is an optional

$data = \moonland\phpexcel\Excel::widget([
		'mode' => 'import', 
		'fileName' => $fileName, 
		'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
		'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
		'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
	]);

$data = \moonland\phpexcel\Excel::import($fileName, [
		'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
		'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
		'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
	]);

// import data with multiple file.

$data = \moonland\phpexcel\Excel::widget([
	'mode' => 'import', 
	'fileName' => [
		'file1' => $fileName1, 
		'file2' => $fileName2, 
		'file3' => $fileName3,
	], 
		'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
		'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
		'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
	]);

$data = \moonland\phpexcel\Excel::import([
	'file1' => $fileName1, 
	'file2' => $fileName2, 
	'file3' => $fileName3,
	], [
		'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
		'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
		'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
	]);

//Result example from the code on the top :

// only one sheet or specified sheet.
Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2));

// data with multiple worksheet
Array([Sheet1] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)), [Sheet2] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)));

// data with multiple file and specified sheet or only one worksheet
Array([file1] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)), [file2] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)));

// data with multiple file and multiple worksheet
Array([file1] => Array([Sheet1] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)), [Sheet2] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2))), [file2] => Array([Sheet1] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2)), [Sheet2] => Array([0] => Array([name] => Anam, [email] => moh.khoirul.anaam@gmail.com, [framework interest] => Yii2), [1] => Array([name] => Example, [email] => example@moonlandsoft.com, [framework interest] => Yii2))));



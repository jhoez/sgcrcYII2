<?php
    $dataCountry=ArrayHelper::map(Country::find()->asArray()->all(),'id', 'name');
    $form = ActiveForm::begin();

    echo $form->field($model, 'id')->dropDownList(
        $dataCountry,
        [
            'prompt'=>'-Choose a Name-',
            'class'=>'adjust',
            'onchange'=>
                '$.post("'.Yii::$app->urlManager->createUrl('city/lists?id=').
                '"+$(this).val(),function( data ){
                    $( "select#city" ).html( data );
                });'
        ]);
        $dataPost=ArrayHelper::map(City::find()->asArray()->all(), 'id', 'city');
        echo $form->field($model, 'id')->dropDownList(
            $dataPost,
            ['id'=>'city','class'=>'adjust']
        );
        ActiveForm::end();
?>

<?php //CONTROLADOR
class CityController extends \yii\web\Controller
{
    public function actionLists($id)
    {
        //echo "<pre>";print_r($id);die;
        $countPosts = City::find()
        ->where(['country_id' => $id])
        ->count();

        $posts = City::find()
        ->where(['country_id' => $id])
        ->orderBy('id DESC')
        ->all();

        if($countPosts>0){
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->city."</option>";
            }
        }else {
            echo "<option>-</option>";
        }
    }
}
?>


//////////////////////////////////////////
You can do it without any widget manually:

make your activeform as follows:

<?=  $form->field($model, 'nameofyourmodel')->dropDownList(
    ArrayHelper::map(\app\models\nameofyourmodel::find()->all(), 'id', 'name'),
    [
        'prompt'=>'smth',
        'onchange' => '
            $.post(
                "' . Url::toRoute('getoperations') . '",
                {id: $(this).val()},
                function(res){
                    $("#requester").html(res);
                }
            );
        ',

    ]
); ?>

and here the second form which receives the id from the first model:

 <?= $form->field($model,'nameofyourmodel')->dropDownList(
    [],
    [
        'prompt' => 'smth',
        'id' => 'requester'
    ]
); ?>

and the last action is to make a functionality in controller to match 2 ids and send them to your model:
<?php
public function actionGetoperations()
{
    if ($id = Yii::$app->request->post('id')) {
        $operationPosts = firstmodel::find()
            ->where(['id' => $id])
            ->count();

        if ($operationPosts > 0) {
            $operations = secondmodel::find()
                ->where(['firstmodelid' => $id])
                ->all();
            foreach ($operations as $operation)
                echo "<option value='" . $operation->firstmodelid. "'>" . $operation->name . "</option>";
        } else
            echo "<option>-</option>";

    }
}
?>

The above code is not working properly. There is an error in the line

$.post("'.Yii::$app->urlManager->createUrl('city/lists&id=').'"+$(this).val(),function( data )

console shows the error : Not Found (#404): Unable to resolve the request: subcategory/lists&id=54

is there any solution for this my controller looks like below
<?php
public function actionLists($id)
      {
         $posts = SubCategory::find()
         ->where(['category_id' => $id])
         ->orderBy('id DESC')
         ->all();

         if($posts){
         foreach($posts as $post){

         echo "<option value='".$post->id."'>".$post->name."</option>";
         }
         }
         else{
         echo "<option>-</option>";
         }

    }
?>
when i remove the id from the url and hard coded it in to controller it works properly.

I have find a solution for this please change your view as follows

<?= $form->field($model, 'category_id')->dropDownList(
    $data,
    [
        'prompt'=>'-Choose a Category-',
        'onchange'=>
            '$.get( "'.Url::toRoute('product/catlists').'", { id: $(this).val() } )
            .done(
                function(data){
                    $( "select#product-sub_categoryid" ).html( data );
                }
            );'
    ]
); ?>

and controller like this
<?php
public function actionCatlists($id)
    {
        $mymodel = new Product ();
        $size = $mymodel->modelGetCategory ( 'product_sub_category',$id );
        if($size){
            echo '<option value="">Choose Sub category</option>';
            foreach($size as $post){
                echo "<option value='".$post['id']."'>".$post['name']."</option>";
            }
        }
        else{
            echo '<option value="0">Not Specified</option>';
        }

    }
?>
don't forget to include this on your view
<?php
use yii\helpers\Url;

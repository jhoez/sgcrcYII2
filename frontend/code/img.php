esto va en el modelo
<?php
public $image;

public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
	];
    }
?>
en el form

<?php
      $form = ActiveForm::begin([
          'options'=>['enctype'=>'multipart/form-data']]); // important
           ?>
 ?>

crear mi pripio escenario
<?php
class SignupForm extends Model
{
       public function rules()
       {
           return [
		//['birth_date', 'checkDateFormat', 'skipOnEmpty' => false, 'skipOnError' => false],//Try forcing the validation on empty field
               [['birth_date'], 'checkDateFormat'],

               // other rules
           ];
       }

       public function scenarios()
       {
           $scenarios = [
               'some_scenario' => ['birth_date'],
           ];

           return array_merge(parent::scenarios(), $scenarios);
       }

       public function checkDateFormat($attribute, $params)
       {
           if($this->birth_date == False)
       {
           $this->addError($attribute, Yii::t('user', 'You entered an invalid date format.'));
       }
       }
}

?>

And in controller set scenario, example:
<?php
$signupForm = new SignupForm(['scenario' => 'some_scenario']);
?>

<?php
////////

public function rules()
{
       return [
           ['new_password','passwordCriteria'],
       ];
}

public function passwordCriteria()
{
       if(!empty($this->new_password)){
           if(strlen($this->new_password)<8){
               $this->addError('new_password','Password must contains eight letters one digit and one character.');
           }
           else{
               if(!preg_match('/[0-9]/',$this->new_password)){
                   $this->addError('new_password','Password must contain one digit.');
               }
               if(!preg_match('/[a-zA-Z]/', $this->new_password)){
                   $this->addError('new_password','Password must contain one character.');
               }
           }
       }
}

<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Usuario;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\Usuario', 'message' => 'El username es requerido.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\Usuario', 'message' => 'El email address es requerido.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Usuario();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password=$this->password;
        $user->auth_key=$this->password;
        $user->password_reset_token=random_int(5, 10);
        $user->status=1;
        $user->created_at=date("Y",time());
        $user->updated_at=date("Y",time());
        $user->verification_token=random_int(5, 10);

        return $user->save();
        //return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to usfrontend @param Usuario $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

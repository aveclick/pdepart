<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $employee_id;
    public $login;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['employee_id', 'login', 'password', 'password_repeat'], 'required'],
            ['employee_id', 'number'],
            [['login', 'password', 'password_repeat'], 'string', 'max' => 255],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            [['login'], 'unique', 'targetClass' => User::class],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/', 'message' => 'Разрешенные символы (латиница, цифры и тире)'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id'], 'message' => 'Текущий табельный номер не найден'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Табельный номер',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Повторение пароля',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function registerUser()
    {
        if ($this->validate()) {
            $user = new User;
            if ($user->load($this->attributes, '')){
                $user -> save(false);
            }
        }
        return $user ?? false;
    }
}

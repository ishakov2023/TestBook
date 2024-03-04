<?php

namespace app\models\Form;

use app\models\User;
use yii\base\Model;


class Registration extends Model
{

    public $username;

    public $password;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Такое логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

}
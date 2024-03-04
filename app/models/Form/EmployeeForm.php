<?php

namespace app\models\Form;

use app\models\Employee;
use yii\base\Model;

class EmployeeForm extends Model
{
    public $name;
    public $position;
    public $user_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['position', 'required'],
            ['position', 'trim'],
            ['position', 'string', 'min' => 2, 'max' => 255],
            ['user_id', 'unique', 'targetClass' => Employee::class, 'message' => 'Такое сотрудник уже есть.'],
            ['user_id', 'required'],
            ['user_id', 'integer'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Сотрудник',
            'position' => 'Должность',
            'user_id' => 'Пользователи',
        ];
    }

}
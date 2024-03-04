<?php

namespace app\models\Form;

use app\models\Author;
use yii\base\Model;

class AuthorForm extends Model
{
    /**
     * @var mixed
     */
    public $name;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => Author::class, 'message' => 'Такое автор уже есть.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО автора',
        ];
    }
}
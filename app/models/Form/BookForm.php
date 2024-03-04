<?php

namespace app\models\Form;

use app\models\Book;
use yii\base\Model;

class BookForm extends Model
{
    public $name;
    public $article;
    public $date_of_receipt;
    public $author_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => Book::class, 'message' => 'Такая книга есть.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['article', 'trim'],
            ['article', 'required'],
            ['article', 'unique', 'targetClass' => Book::class, 'message' => 'Такой Артикул уже есть.'],
            ['article', 'string', 'min' => 2, 'max' => 255],
            ['date_of_receipt', 'required'],
            ['author_id', 'required'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'article' => 'Артикул',
            'date_of_receipt' => 'Дата поступления',
            'author_id' => 'Автор',
        ];
    }

}
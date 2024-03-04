<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $article
 * @property string $date_of_receipt
 * @property int $author_id
 * @property boolean $in_stock
 */

class Book extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'books';
    }

    public function rules(): array
    {
        return [
            [['name', 'article', 'date_of_receipt', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['name', 'article'], 'string', 'max' => 255],
            [['date_of_receipt'], 'date', 'format' => 'php:Y-m-d'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['in_stock'],'boolean']
        ];
    }

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
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getBookCheckouts(): ActiveQuery
    {
        return $this->hasMany(BookCheckout::class, ['book_id' => 'id']);
    }
}
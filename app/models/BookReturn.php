<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property int $book_id
 * @property int $employee_id
 * @property string $date_of_return
 * @property int $book_condition_id
 */

class BookReturn extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book_return';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['book_id', 'employee_id', 'date_of_return', 'book_condition_id'], 'required'],
            [['book_id', 'employee_id', 'book_condition_id'], 'integer'],
            [['date_of_return'], 'date', 'format' => 'php:Y-m-d'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['book_condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => BookCondition::class, 'targetAttribute' => ['book_condition_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'book_id' => 'Книга',
            'employee_id' => 'Сотрудник',
            'date_of_return' => 'Дата возврата',
            'book_condition_id' => 'Состояние книги',
        ];
    }

    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    public function getEmployee(): ActiveQuery
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public function getBookCondition(): ActiveQuery
    {
        return $this->hasOne(BookCondition::class, ['id' => 'book_condition_id']);
    }
}
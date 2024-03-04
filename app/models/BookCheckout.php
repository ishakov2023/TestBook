<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property int $book_id
 * @property int $client_id
 * @property int $employee_id
 * @property string $date_of_checkout
 * @property string $return_book
 */
class BookCheckout extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_checkouts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'client_id', 'employee_id', 'date_of_checkout'], 'required'],
            [['book_id', 'client_id', 'employee_id'], 'integer'],
            [['date_of_checkout'], 'date', 'format' => 'php:Y-m-d'],
            [['return_date'], 'date', 'format' => 'php:Y-m-d'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Книга',
            'client_id' => 'Клиент',
            'employee_id' => 'Сотрудник',
            'date_of_checkout' => 'Дата выдачи',
            'return_date' => 'Дата возврата',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }


    public function getClient(): ActiveQuery
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    public function getBookReturn()
    {
        return $this->hasOne(BookReturn::class, ['book_id' => 'book_id']);
    }

    public function getEmployee(): ActiveQuery
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }
}

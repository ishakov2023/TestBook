<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $condition
 */
class BookCondition extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'book_condition';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Состояние',
        ];
    }

    public function getBookReturns(): ActiveQuery
    {
        return $this->hasMany(BookReturn::class, ['book_condition_id' => 'id']);
    }
}
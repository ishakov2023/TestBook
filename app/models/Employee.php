<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property int $user_id
 */

class Employee extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'employees';
    }


    public function rules(): array
    {
        return [
            [['name', 'position'], 'required'],
            [['name', 'position'], 'string', 'max' => 255],
            ['user_id', 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Сотрудник',
            'position' => 'Должность',
            'user_id' => 'Пользователи',
        ];
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $user = User::findOne($this->user_id);
                $user->role = 'employee';
                $user->save();
            }
            return true;
        }
        return false;
    }
    public function getBookCheckouts(): ActiveQuery
    {
        return $this->hasMany(BookCheckout::class, ['employee_id' => 'id']);
    }
    public function getBookReturns(): ActiveQuery
    {
        return $this->hasMany(BookReturn::class, ['employee_id' => 'id']);
    }
}

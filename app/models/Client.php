<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $passport_series
 * @property string $passport_number
 */
class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'passport_series', 'passport_number'], 'required'],
            [['passport_series'], 'string', 'max' => 4],
            [['passport_number'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'passport_series' => 'Серия паспорта',
            'passport_number' => 'Номер паспорта',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBookCheckout(): ActiveQuery
    {
        return $this->hasMany(BookCheckout::class, ['client_id' => 'id']);
    }
}
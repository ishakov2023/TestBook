<?php

namespace app\models\Form;

use app\models\Client;
use yii\base\Model;

class ClientForm extends Model
{
    public $name;
    public $passport_series;
    public $passport_number;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['passport_series', 'trim'],
            ['passport_series', 'required'],
            ['passport_series', 'string', 'min' => 4, 'max' => 4],
            ['passport_number', 'trim'],
            ['passport_number', 'required'],
            ['passport_number', 'string', 'min' => 6, 'max' => 6],
            [['passport_series', 'passport_number'], 'validatePassport'],

        ];
    }

    /**
     * @return string[]
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
     * @param $attribute
     * @return void
     */
    public function validatePassport($attribute)
    {
        $passportSeries = $this->passport_series;
        $passportNumber = $this->passport_number;
        if (!$passportSeries || !$passportNumber) {
            $this->addError($attribute, 'Серия и номер паспорта обязательны');
            return;
        }

        $client = Client::find()
            ->where([
                'passport_series' => $passportSeries,
                'passport_number' => $passportNumber,
            ])
            ->one();
        if ($client) {
            $this->addError($attribute, 'Такой пользователь уже существует.');
        }
    }
}
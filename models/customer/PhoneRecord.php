<?php

namespace app\models\customer;

use yii\db\ActiveRecord;

/**
 * @property integer $customer_id
 * @property string $number
 *
 * Class PhoneRecord
 * @package app\models\customer
 */
class PhoneRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'phone';
    }

    public function rules()
    {
        return [
            ['customer_id', 'number'],
            ['number', 'string'],
            [['customer_id', 'number'], 'required'],
        ];
    }
}

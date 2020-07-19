<?php

namespace app\models\customer;

use DateTime;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property DateTime $birth_date
 * @property string $notes
 *
 * Class CustomerRecord
 * @package app\models\customer
 */
class CustomerRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            ['id', 'number'],
            ['name', 'required'],
            ['name', 'string', 'max' => 256],
            ['birth_date', 'date', 'format' => 'Y-m-d'],
            ['notes', 'safe'],
        ];
    }
}

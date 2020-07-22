<?php

namespace app\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $hourly_rate
 */
class ServiceRecord extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hourly_rate'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'hourly_rate' => 'Hourly Rate',
        ];
    }
}

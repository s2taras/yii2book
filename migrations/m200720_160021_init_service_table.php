<?php

use yii\db\Migration;

/**
 * Class m200720_160021_init_services_table
 */
class m200720_160021_init_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service', [
            'id' => 'pk',
            'name' => 'string unique',
            'hourly_rate' => 'integer',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service');
    }
}

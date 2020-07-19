<?php

use yii\db\Migration;

/**
 * Class m200719_111805_init_customer_table
 */
class m200719_111805_init_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => 'pk',
            'name' => 'string',
            'birth_date' => 'date',
            'notes' => 'text',
        ], 'ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer');
    }
}

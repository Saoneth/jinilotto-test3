<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_details}}`.
 */
class m200219_010331_create_customer_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->db = 'db_destination';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_details}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->char(201)->notNull(),
            'e_mail' => $this->char(255)->notNull(),
            'balance' => $this->decimal(10,2)->notNull(),
            'totalpurchase' => $this->decimal(10,2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_details}}');
    }
}

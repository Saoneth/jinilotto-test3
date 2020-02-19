<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_details}}`.
 */
class m200219_010058_create_user_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->db = 'db_source';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_details}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'surname' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'data' => $this->float()->notNull(),
            'data2' => $this->decimal(10,2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_details}}');
    }
}

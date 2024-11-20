<?php

use yii\db\Migration;

/**
 * Class m241120_114454_create_table_visit
 */
class m241120_114454_create_table_visit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('visit', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241120_114454_create_table_visit cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241120_114454_create_table_visit cannot be reverted.\n";

        return false;
    }
    */
}

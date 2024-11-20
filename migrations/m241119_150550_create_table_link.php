<?php

use yii\db\Migration;

/**
 * Class m241119_150550_create_table_link
 */
class m241119_150550_create_table_link extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'short_link' => $this->string()->notNull()->unique(),
            'link' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addCommentOnTable('link', 'Short links');
        $this->addCommentOnColumn('link', 'user_id', 'User ID');
        $this->addCommentOnColumn('link', 'short_link', 'Short link');
        $this->addCommentOnColumn('link', 'link', 'Original link');
        $this->addCommentOnColumn('link', 'created_at', 'Created at time');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('link');
    }

}

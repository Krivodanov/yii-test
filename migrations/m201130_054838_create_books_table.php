<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m201130_054838_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id'        => $this->primaryKey(),
            'author_id' => $this->integer(),
            'year'      => $this->integer(),
            'name'      => $this->char(200),
            'rating'    => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}

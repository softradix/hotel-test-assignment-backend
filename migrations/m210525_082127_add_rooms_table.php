<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210525_082127_add_rooms_table
 */
class m210525_082127_add_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("rooms", [
            "id" => Schema::TYPE_PK,
            "room_number" => Schema::TYPE_STRING,
            "created_at" => Schema::TYPE_DATETIME
         ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rooms');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210525_082127_add_rooms_table cannot be reverted.\n";

        return false;
    }
    */
}

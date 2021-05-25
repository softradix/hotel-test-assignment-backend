<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210525_082613_add_rooms_day_price_table
 */
class m210525_082613_add_rooms_day_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("rooms_day_price", [
            "id" => Schema::TYPE_PK,
            "room_id" => Schema::TYPE_BIGINT,
            "date" => Schema::TYPE_DATE,
            "price" => Schema::TYPE_DECIMAL,
            "availability" => Schema::TYPE_TINYINT,
            "created_at" => Schema::TYPE_DATETIME
         ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rooms_day_price');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210525_082613_add_rooms_day_price_table cannot be reverted.\n";

        return false;
    }
    */
}

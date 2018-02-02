<?php

use yii\db\Migration;

/**
 * Class m180201_164745_create_communities
 */
class m180201_164745_create_communities extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180201_164745_create_communities cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') { // Тип БД, далее тип таблицы и стандартная кодировка для этой таблицы.
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_bin ENGINE=InnoDB';
        }
        $this->createTable('communities', [
            'communities_id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->string(50)->notNull(),
            'name' => $this->string(25)->notNull(),
            'urlimg' => $this->string(25)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m180201_164745_create_communities cannot be reverted.\n";

        return false;
    }
}

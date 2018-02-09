<?php

use yii\db\Migration;

/**
 * Class m180201_170121_create_user_details
 */
class m180201_170121_create_user_details extends Migration
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
        echo "m180201_170121_create_user_details cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') { // Тип БД, далее тип таблицы и стандартная кодировка для этой таблицы.
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_bin ENGINE=InnoDB';
        }
        $this->createTable('user_details', [
            'user_details_id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'userAvatar' => $this->text(65000)->defaultValue(Null),
            'userImage' => $this->text(65000)->defaultValue(Null),
            'userInfo' => $this->text(5000)->defaultValue(Null),
            'userCategories' => $this->text(250)->defaultValue(Null),
            'userPhone' => $this->text(25)->defaultValue(Null),
            'userCity' => $this->text(50)->defaultValue(Null),
            'userVK' => $this->text(255)->defaultValue(Null),
            'userFB' => $this->text(255)->defaultValue(Null),
            'userInstagram' => $this->text(255)->defaultValue(Null),
            'userTwitter' => $this->text(255)->defaultValue(Null),
            'userRating' => $this->integer(60)->defaultValue(Null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


    }

    public function down()
    {
        echo "m180201_170121_create_user_details cannot be reverted.\n";

        return false;
    }

}

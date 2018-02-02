<?php

use yii\db\Migration;

/**
 * Class m180201_170329_create_user_to_events
 */
class m180201_170329_create_user_to_events extends Migration
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
        echo "m180201_170329_create_user_to_events cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180201_170329_create_user_to_events cannot be reverted.\n";

        return false;
    }
    */
}

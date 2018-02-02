<?php

use yii\db\Migration;

/**
 * Class m180201_170201_create_user_to_communities
 */
class m180201_170201_create_user_to_communities extends Migration
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
        echo "m180201_170201_create_user_to_communities cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('post_tag', [
        'post_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'PRIMARY KEY(post_id, tag_id)',
        ]);
    }

    public function down()
    {
        echo "m180201_170201_create_user_to_communities cannot be reverted.\n";

        return false;
    }

}

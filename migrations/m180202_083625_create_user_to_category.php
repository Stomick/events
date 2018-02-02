<?php

use yii\db\Migration;

/**
 * Class m180202_083625_create_user_to_category
 */
class m180202_083625_create_user_to_category extends Migration
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
        echo "m180202_083625_create_user_to_category cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('user_to_category', [
            'user_id' => $this->integer(),
            'category_id' => $this->integer(),
            'PRIMARY KEY(user_id, category_id)',
        ]);
        $this->addForeignKey(
            'user_id',
            'user_to_category',
            'user_id',
            'user',
            'user_id',
            'CASCADE'
        );
        $this->addForeignKey(
            'category_id',
            'user_to_category',
            'category_id',
            'category',
            'category_id',
            'CASCADE'
        );

    }

    public function down()
    {
        echo "m180202_083625_create_user_to_category cannot be reverted.\n";

        return false;
    }

}

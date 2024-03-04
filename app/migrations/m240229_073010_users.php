<?php

use yii\db\Migration;

/**
 * Class m240229_073010_users
 */
class m240229_073010_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('users', [
            'id'         => $this->primaryKey(),
            'username'   => $this->string(255)->notNull()->unique(),
            'password'   => $this->string(255)->notNull(),
            'role'       => $this->string(255)->notNull()->defaultValue('employee'),
            'is_active'  => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240229_073010_users cannot be reverted.\n";

        return false;
    }
    */
}

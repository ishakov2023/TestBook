<?php

use yii\db\Migration;

/**
 * Class m240229_074355_book_condition
 */
class m240229_074005_book_condition extends Migration
{
    public function up()
    {
        $this->createTable('book_condition', [
            'id' => $this->primaryKey(),
            'condition' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('book_condition');
    }
}

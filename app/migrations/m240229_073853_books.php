<?php

use yii\db\Migration;

/**
 * Class m240229_073853_books
 */
class m240229_073853_books extends Migration
{
    public function up()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'article' => $this->string(255)->notNull(),
            'date_of_receipt' => $this->date()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'in_stock' => $this->boolean()->notNull()->defaultValue(true),
        ]);

        $this->addForeignKey(
            'fk_book_author',
            'books',
            'author_id',
            'authors',
            'id',
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_book_author', 'books');
        $this->dropTable('books');
    }
}

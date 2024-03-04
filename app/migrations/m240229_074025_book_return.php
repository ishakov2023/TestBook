<?php

use yii\db\Migration;

/**
 * Class m240229_074025_book_return
 */
class m240229_074025_book_return extends Migration
{
    public function up()
    {
        $this->createTable('book_return', [
            'id'                => $this->primaryKey(),
            'book_id'           => $this->integer()->notNull(),
            'employee_id'       => $this->integer()->notNull(),
            'date_of_return'    => $this->date()->notNull(),
            'book_condition_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_book_return_book',
            'book_return',
            'book_id',
            'books',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_book_return_employee',
            'book_return',
            'employee_id',
            'employees',
            'id',
        );

        $this->addForeignKey(
            'fk_book_return_condition',
            'book_return',
            'book_condition_id',
            'book_condition',
            'id',
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_book_return_condition', 'book_return');
        $this->dropForeignKey('fk_book_return_employee', 'book_return');
        $this->dropForeignKey('fk_book_return_book', 'book_return');
        $this->dropTable('book_return');
    }
}

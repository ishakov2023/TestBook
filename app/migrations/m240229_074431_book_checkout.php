<?php

use yii\db\Migration;

/**
 * Class m240229_074431_book_checkout
 */
class m240229_074431_book_checkout extends Migration
{
    public function up()
    {
        $this->createTable('book_checkouts', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'date_of_checkout' => $this->date()->notNull(),
            'return_date' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_book_checkout_book',
            'book_checkout',
            'book_id',
            'books',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_book_checkout_client',
            'book_checkout',
            'client_id',
            'clients',
            'id',
        );

        $this->addForeignKey(
            'fk_book_checkout_employee',
            'book_checkout',
            'employee_id',
            'employees',
            'id',
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_book_checkout_employee', 'book_checkout');
        $this->dropForeignKey('fk_book_checkout_client', 'book_checkout');
        $this->dropForeignKey('fk_book_checkout_book', 'book_checkout');
        $this->dropTable('book_checkout');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m240229_073221_employees
 */
class m240229_073221_employees extends Migration
{public function up()
{
    $this->createTable('employees', [
        'id'       => $this->primaryKey(),
        'name'     => $this->string(255)->notNull(),
        'position' => $this->string(255)->notNull(),
        'user_id'  => $this->integer()->notNull(),
    ]);

    $this->addForeignKey(
        'fk_employee_user',
        'employees',
        'user_id',
        'users',
        'id',
    );
}

    public function down()
    {
        $this->dropForeignKey('fk_employee_user', 'employees');
        $this->dropTable('employees');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m240229_073411_clients
 */
class m240229_073411_clients extends Migration
{
    public function up()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'passport_series' => $this->string(4)->notNull(),
            'passport_number' => $this->string(6)->notNull(),
            'has_book'       => $this->boolean()->notNull()->defaultValue(false),
        ]);

        $this->createIndex(
            'client_passport_unique',
            'clients',
            ['passport_series', 'passport_number'],
            true
        );
    }

    public function down()
    {
        $this->dropIndex('client_passport_unique', 'clients');
        $this->dropTable('clients');
    }
}

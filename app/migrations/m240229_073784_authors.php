<?php

use yii\db\Migration;

/**
 * Class m240229_074114_authors
 */
class m240229_073784_authors extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    public function down()
    {
        $this->dropIndex('author_name_unique', 'authors');
        $this->dropTable('authors');
    }
}

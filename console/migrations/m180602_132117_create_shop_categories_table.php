<?php

use yii\db\Migration;

class m180602_132117_create_shop_categories_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%shop_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-shop_categories-slug}}',
            '{{%shop_categories}}',
            'slug',
            true
        );

        $this->insert('{{%shop_categories}}', [
            'id' => 1,
            'name' => '',
            'slug' => 'root',
            'title' => null,
            'description' => null,
            'meta_json' => '{}',
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%shop_categories}}');
    }
}

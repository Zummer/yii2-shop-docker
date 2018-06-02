<?php

use yii\db\Migration;

class m180601_165903_create_shop_brands_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%shop_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'meta_json' => 'JSON NOT NULL',
        ]);

        $this->createIndex('{{%idx-shop_brands-slug}}', '{{%shop_brands}}', 'slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%shop_brands}}');
    }
}

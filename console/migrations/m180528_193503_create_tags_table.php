<?php

use yii\db\Migration;

class m180528_193503_create_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%shop_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%shop_tags}}');
    }
}

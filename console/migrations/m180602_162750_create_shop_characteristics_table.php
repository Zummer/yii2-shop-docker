<?php

use yii\db\Migration;

class m180602_162750_create_shop_characteristics_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%shop_characteristics}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->string(16)->notNull(),
            'required' => $this->boolean()->notNull(),
            'default' => $this->string(),
            'variants_json' => 'JSON NOT NULL',
            'sort' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%shop_characteristics}}');
    }
}

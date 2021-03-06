<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_shop`.
 */
class m180115_082931_create_category_shop_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_shop', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'icon' => $this->string(255)->defaultValue(null),
            'meta_title' => $this->string(255)->notNull(),
            'meta_description' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_shop');
    }
}

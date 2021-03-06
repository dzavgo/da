<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tariff`.
 */
class m170703_080844_create_tariff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tariff', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'descr' => $this->text(),
            'price' => $this->integer(11)->notNull(),
            'published' => $this->integer(1)->defaultValue(0),
            'icon' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tariff');
    }
}

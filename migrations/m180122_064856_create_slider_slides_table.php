<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider_slides`.
 */
class m180122_064856_create_slider_slides_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
//        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
//
//        $this->createTable('slider_slides', [
//            'id' => $this->primaryKey(),
//            'sort' => $this->integer()->notNull(),
//            'blank' => $this->boolean()->notNull(),
//            'active' => $this->boolean()->notNull(),
//            'onelang' => $this->boolean()->notNull(),
//            'created_at' => $this->integer()->unsigned()->notNull(),
//            'created_by' => $this->integer()->notNull(),
//            'updated_at' => $this->integer()->unsigned()->notNull(),
//            'updated_by' => $this->integer()->notNull(),
//        ], $tableOptions);
//
//        $this->createIndex('{{%index-slider_slides-active}}', '{{%slider_slides}}', 'active');
//
//        $this->createIndex('{{%index-slider_slides-created_by}}', '{{%slider_slides}}', 'created_by');
//        $this->addForeignKey('{{%fkey-slider_slides-created_by}}', '{{%slider_slides}}', 'created_by', '{{%users}}', 'id', 'RESTRICT', 'RESTRICT');
//
//        $this->createIndex('{{%index-slider_slides-updated_by}}', '{{%slider_slides}}', 'updated_by');
//        $this->addForeignKey('{{%fkey-slider_slides-updated_by}}', '{{%slider_slides}}', 'updated_by', '{{%users}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
//        $this->dropTable('slider_slides');
    }
}

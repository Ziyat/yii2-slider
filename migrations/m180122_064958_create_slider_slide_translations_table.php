<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider_slide_translations`.
 */
class m180122_064958_create_slider_slide_translations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('slider_slide_translations', [
            'id' => $this->primaryKey(),
            'slide_id' => $this->integer()->notNull(),
            'lang_id' => $this->integer()->notNull(),
            'file' => $this->string(255),
            'link' => $this->string(255),
            'name' => $this->string(255),
            'description' => $this->text(),
        ], $tableOptions);

        $this->createIndex('{{%idx-slider_slide_translations-slide_id}}', '{{%slider_slide_translations}}', 'slide_id');
        $this->addForeignKey('{{%fk-slider_slide_translations-slide_id}}', '{{%slider_slide_translations}}', 'slide_id', '{{%slider_slides}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('slider_slide_translations');
    }
}

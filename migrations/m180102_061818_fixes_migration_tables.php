<?php

use yii\db\Migration;

/**
 * Class m180205_061818_fix_migration_table
 */
class m180102_061818_fixes_migration_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->delete('{{%migration}}', ['version' => 'm180122_064855_create_slider_slides_table']);
        $this->delete('{{%migration}}', ['version' => 'm180122_064958_create_slider_slide_translations_table']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
//        echo "m180205_061818_fix_migration_table cannot be reverted.\n";
//
//        return false;
    }

}

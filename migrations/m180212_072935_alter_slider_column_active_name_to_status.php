<?php

use yii\db\Migration;

/**
 * Class m180212_072935_alter_slider_column_active_name_to_status
 */
class m180212_072935_alter_slider_column_active_name_to_status extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn('{{%slider_slides}}', 'active', 'status');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180212_072935_alter_slider_column_active_name_to_status cannot be reverted.\n";

        return false;
    }
}

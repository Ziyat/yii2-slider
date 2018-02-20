<?php

use yii\db\Migration;

/**
 * Class m180202_102043_alter_slide_file_column
 */
class m180202_102043_alter_slide_file_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
//        $this->alterColumn('{{%slider_slide_translations}}', 'file', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180202_102043_alter_slide_file_column cannot be reverted.\n";

        return false;
    }
}

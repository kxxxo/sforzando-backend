<?php

use yii\db\Migration;

/**
 * Class m210501_184540_remove_column_from_gallery_item
 */
class m210501_184540_remove_column_from_gallery_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('gallery_file','original_path');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210501_184540_remove_column_from_gallery_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210501_184540_remove_column_from_gallery_item cannot be reverted.\n";

        return false;
    }
    */
}

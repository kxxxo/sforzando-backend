<?php

use yii\db\Migration;

/**
 * Class m210501_183305_create_gallery_preview
 */
class m210501_183305_create_gallery_preview extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('gallery_file', 'preview_url',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210501_183305_create_gallery_preview cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210501_183305_create_gallery_preview cannot be reverted.\n";

        return false;
    }
    */
}

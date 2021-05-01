<?php

use yii\db\Migration;

/**
 * Class m210501_181409_create_gallery
 */
class m210501_181409_create_gallery extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery_folder',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'original_path'=>$this->string()->notNull()
        ]);

        $this->createTable('gallery_file',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'original_path'=>$this->string()->notNull(),
            'url'=>$this->string()->notNull(),
            'gallery_folder_id'=>$this->integer()->notNull()
        ]);

        $this->addForeignKey('FK_gallery_file_folder_id','gallery_file','gallery_folder_id','gallery_folder','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210501_181409_create_gallery cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210501_181409_create_gallery cannot be reverted.\n";

        return false;
    }
    */
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_file".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $preview_url
 * @property int $gallery_folder_id
 *
 * @property GalleryFolder $galleryFolder
 */
class GalleryFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url','preview_url', 'gallery_folder_id'], 'required'],
            [['gallery_folder_id'], 'default', 'value' => null],
            [['gallery_folder_id'], 'integer'],
            [['name', 'url','preview_url'], 'string', 'max' => 255],
            [['gallery_folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryFolder::className(), 'targetAttribute' => ['gallery_folder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'preview_url'=>'preview url',
            'gallery_folder_id' => 'Gallery Folder ID',
        ];
    }

    /**
     * Gets query for [[GalleryFolder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFolder()
    {
        return $this->hasOne(GalleryFolder::className(), ['id' => 'gallery_folder_id']);
    }
}

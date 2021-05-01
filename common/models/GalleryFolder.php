<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_folder".
 *
 * @property int $id
 * @property string $name
 * @property string $original_path
 * @property int $parent_id
 *
 * @property GalleryFile[] $galleryFiles
 * @property GalleryFolder $parentFolder
 */
class GalleryFolder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_folder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'original_path'], 'required'],
            [['name', 'original_path'], 'string', 'max' => 255],
            ['parent_id','integer']
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
            'original_path' => 'Original Path',
        ];
    }

    /**
     * Gets query for [[GalleryFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFiles()
    {
        return $this->hasMany(GalleryFile::className(), ['gallery_folder_id' => 'id']);
    }

    public function getParentFolder()
    {
        return $this->hasOne(GalleryFolder::className(), ['id' => 'parent_id']);
    }
}

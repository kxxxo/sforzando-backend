<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "jury".
 *
 * @property int $id
 * @property string $img_url
 *
 * @property JuryLanguage[] $juryLanguages
 */
class Jury extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jury';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img_url'], 'required'],
            [['img_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_url' => 'Img Url',
        ];
    }

    /**
     * Gets query for [[JuryLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJuryLanguages()
    {
        return $this->hasMany(JuryLanguage::className(), ['jury_id' => 'id']);
    }
}

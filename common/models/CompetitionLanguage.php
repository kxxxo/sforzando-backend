<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "compilation_language".
 *
 * @property int $id
 * @property int $language_id
 * @property string $title
 * @property string $text
 * @property int $competition_id
 *
 * @property Competition $competition
 * @property Language $language
 */
class CompetitionLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competition_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'competition_id'], 'required'],
            [['language_id', 'competition_id'], 'default', 'value' => null],
            [['language_id', 'competition_id'], 'integer'],
            [['title', 'text'], 'string'],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competition::className(), 'targetAttribute' => ['competition_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ID',
            'title' => 'Title',
            'text' => 'Text',
            'competition_id' => 'competition id',
        ];
    }

    /**
     * Gets query for [[competition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition()
    {
        return $this->hasOne(Competition::className(), ['id' => 'competition_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}

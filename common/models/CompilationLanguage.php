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
 * @property int $compilation_id
 *
 * @property Compilation $compilation
 * @property Language $language
 */
class CompilationLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compilation_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'title', 'text', 'compilation_id'], 'required'],
            [['language_id', 'compilation_id'], 'default', 'value' => null],
            [['language_id', 'compilation_id'], 'integer'],
            [['title', 'text'], 'string'],
            [['compilation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compilation::className(), 'targetAttribute' => ['compilation_id' => 'id']],
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
            'compilation_id' => 'Compilation ID',
        ];
    }

    /**
     * Gets query for [[Compilation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompilation()
    {
        return $this->hasOne(Compilation::className(), ['id' => 'compilation_id']);
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

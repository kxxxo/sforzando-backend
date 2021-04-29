<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $name
 * @property bool $enable
 * @property string $i18_name
 *
 * @property CompetitionLanguage[] $compilationLanguages
 * @property JudgeLanguage[] $judgeLanguages
 */
class Language extends \yii\db\ActiveRecord
{
    const RUSSIAN = 1;
    const ENGLISH = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'i18_name'], 'required'],
            [['enable'], 'boolean'],
            [['name', 'i18_name'], 'string', 'max' => 255],
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
            'enable' => 'Enable',
            'i18_name' => 'I18 Name',
        ];
    }

    /**
     * Gets query for [[CompilationLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitionLanguages()
    {
        return $this->hasMany(CompetitionLanguage::className(), ['language_id' => 'id']);
    }

    /**
     * Gets query for [[judgeLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJudgeLanguages()
    {
        return $this->hasMany(JudgeLanguage::className(), ['language_id' => 'id']);
    }
}

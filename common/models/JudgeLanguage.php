<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "judge_language".
 *
 * @property int $id
 * @property int $language_id
 * @property int $judge_id
 * @property string $fio
 * @property string $description
 *
 * @property Judge $judge
 * @property Language $language
 */
class JudgeLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judge_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'judge_id', 'fio', 'description'], 'required'],
            [['language_id', 'judge_id'], 'default', 'value' => null],
            [['language_id', 'judge_id'], 'integer'],
            [['description'], 'string'],
            [['fio'], 'string', 'max' => 255],
            [['judge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Judge::className(), 'targetAttribute' => ['judge_id' => 'id']],
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
            'judge_id' => 'judge ID',
            'fio' => 'Fio',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[judge]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJudge()
    {
        return $this->hasOne(Judge::className(), ['id' => 'judge_id']);
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

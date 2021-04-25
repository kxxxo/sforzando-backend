<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "judge".
 *
 * @property int $id
 * @property string $img_url
 *
 * @property JudgeLanguage[] $judgeLanguages
 */
class Judge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'judge';
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
     * Gets query for [[JudgeLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJudgeLanguages()
    {
        return $this->hasMany(JudgeLanguage::className(), ['judge_id' => 'id']);
    }
}

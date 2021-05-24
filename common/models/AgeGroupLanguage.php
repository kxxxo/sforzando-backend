<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "age_group_language".
 *
 * @property int $id
 * @property int|null $age_group_id
 * @property string|null $name
 * @property int|null $language_id
 *
 * @property AgeGroup $ageGroup
 * @property Language $language
 */
class AgeGroupLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age_group_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age_group_id', 'language_id'], 'default', 'value' => null],
            [['age_group_id', 'language_id'], 'integer'],
            [['name'], 'string'],
            [['age_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgeGroup::className(), 'targetAttribute' => ['age_group_id' => 'id']],
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
            'age_group_id' => 'Age Group ID',
            'name' => 'Name',
            'language_id' => 'Language ID',
        ];
    }

    /**
     * Gets query for [[AgeGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgeGroup()
    {
        return $this->hasOne(AgeGroup::className(), ['id' => 'age_group_id']);
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

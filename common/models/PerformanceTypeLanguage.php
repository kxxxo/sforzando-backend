<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "performance_type_language".
 *
 * @property int $id
 * @property int|null $performance_type_id
 * @property string|null $name
 * @property int|null $language_id
 *
 * @property Language $language
 * @property PerformanceType $performanceType
 */
class PerformanceTypeLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'performance_type_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['performance_type_id', 'language_id'], 'default', 'value' => null],
            [['performance_type_id', 'language_id'], 'integer'],
            [['name'], 'string'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['performance_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerformanceType::className(), 'targetAttribute' => ['performance_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'performance_type_id' => 'Performance Type ID',
            'name' => 'Name',
            'language_id' => 'Language ID',
        ];
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

    /**
     * Gets query for [[PerformanceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformanceType()
    {
        return $this->hasOne(PerformanceType::className(), ['id' => 'performance_type_id']);
    }
}

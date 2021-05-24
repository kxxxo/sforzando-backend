<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competition_performance_types".
 *
 * @property int $id
 * @property int|null $competition_id
 * @property int|null $performance_type_id
 *
 * @property Competition $competition
 * @property PerformanceType $performanceType
 */
class CompetitionPerformanceTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competition_performance_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competition_id', 'performance_type_id'], 'default', 'value' => null],
            [['competition_id', 'performance_type_id'], 'integer'],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competition::className(), 'targetAttribute' => ['competition_id' => 'id']],
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
            'competition_id' => 'Competition ID',
            'performance_type_id' => 'Performance Type ID',
        ];
    }

    /**
     * Gets query for [[Competition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition()
    {
        return $this->hasOne(Competition::className(), ['id' => 'competition_id']);
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

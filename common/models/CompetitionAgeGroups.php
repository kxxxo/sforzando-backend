<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competition_age_groups".
 *
 * @property int $id
 * @property int|null $competition_id
 * @property int|null $age_group_id
 *
 * @property AgeGroup $ageGroup
 * @property Competition $competition
 */
class CompetitionAgeGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competition_age_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competition_id', 'age_group_id'], 'default', 'value' => null],
            [['competition_id', 'age_group_id'], 'integer'],
            [['age_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgeGroup::className(), 'targetAttribute' => ['age_group_id' => 'id']],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competition::className(), 'targetAttribute' => ['competition_id' => 'id']],
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
            'age_group_id' => 'Age Group ID',
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
     * Gets query for [[Competition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition()
    {
        return $this->hasOne(Competition::className(), ['id' => 'competition_id']);
    }
}

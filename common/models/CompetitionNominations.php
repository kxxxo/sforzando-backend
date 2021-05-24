<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competition_nominations".
 *
 * @property int $id
 * @property int|null $competition_id
 * @property int|null $nomination_id
 *
 * @property Competition $competition
 * @property Nomination $nomination
 */
class CompetitionNominations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competition_nominations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competition_id', 'nomination_id'], 'default', 'value' => null],
            [['competition_id', 'nomination_id'], 'integer'],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competition::className(), 'targetAttribute' => ['competition_id' => 'id']],
            [['nomination_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nomination::className(), 'targetAttribute' => ['nomination_id' => 'id']],
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
            'nomination_id' => 'Nomination ID',
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
     * Gets query for [[Nomination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNomination()
    {
        return $this->hasOne(Nomination::className(), ['id' => 'nomination_id']);
    }
}

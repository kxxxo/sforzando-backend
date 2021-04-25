<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "compilation".
 *
 * @property int $id
 * @property string|null $create_datetime
 * @property string $request_end_datetime
 * @property string $start_date
 * @property string $img_url
 * @property bool $is_ended
 * @property string $result_url
 *
 * @property CompetitionLanguage[] $compilationLanguages
 */
class Competition extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_datetime', 'request_end_datetime', 'start_date'], 'safe'],
            [['request_end_datetime', 'start_date', 'img_url'], 'required'],
            [['img_url','result_url'], 'string'],
            [['is_ended'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_datetime' => 'Create Datetime',
            'request_end_datetime' => 'Request End Datetime',
            'start_date' => 'Start Datetime',
            'img_url' => 'Img Url',
            'is_ended' => 'Is Ended',
        ];
    }

    /**
     * Gets query for [[CompetitionLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitionLanguages()
    {
        return $this->hasMany(CompetitionLanguage::className(), ['competition_id' => 'id']);
    }
}

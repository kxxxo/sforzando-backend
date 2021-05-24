<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nomination_language".
 *
 * @property int $id
 * @property int|null $nomination_id
 * @property string|null $name
 * @property int|null $language_id
 *
 * @property Language $language
 * @property Nomination $nomination
 */
class NominationLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomination_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomination_id', 'language_id'], 'default', 'value' => null],
            [['nomination_id', 'language_id'], 'integer'],
            [['name'], 'string'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
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
            'nomination_id' => 'Nomination ID',
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
     * Gets query for [[Nomination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNomination()
    {
        return $this->hasOne(Nomination::className(), ['id' => 'nomination_id']);
    }
}

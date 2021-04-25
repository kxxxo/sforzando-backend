<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "jury_language".
 *
 * @property int $id
 * @property int $language_id
 * @property int $jury_id
 * @property string $fio
 * @property string $description
 *
 * @property Jury $jury
 * @property Language $language
 */
class JuryLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jury_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'jury_id', 'fio', 'description'], 'required'],
            [['language_id', 'jury_id'], 'default', 'value' => null],
            [['language_id', 'jury_id'], 'integer'],
            [['description'], 'string'],
            [['fio'], 'string', 'max' => 255],
            [['jury_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jury::className(), 'targetAttribute' => ['jury_id' => 'id']],
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
            'jury_id' => 'Jury ID',
            'fio' => 'Fio',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Jury]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJury()
    {
        return $this->hasOne(Jury::className(), ['id' => 'jury_id']);
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

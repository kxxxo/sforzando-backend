<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "compilation".
 *
 * @property int $id
 * @property string|null $create_datetime
 * @property string $request_end_datetime
 * @property string $start_datetime
 * @property string $img_url
 * @property bool $is_ended
 *
 * @property CompilationLanguage[] $compilationLanguages
 */
class Compilation extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compilation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_datetime', 'request_end_datetime', 'start_datetime'], 'safe'],
            [['request_end_datetime', 'start_datetime', 'img_url'], 'required'],
            [['img_url'], 'string'],
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
            'start_datetime' => 'Start Datetime',
            'img_url' => 'Img Url',
            'is_ended' => 'Is Ended',
        ];
    }

    /**
     * Gets query for [[CompilationLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompilationLanguages()
    {
        return $this->hasMany(CompilationLanguage::className(), ['compilation_id' => 'id']);
    }
}

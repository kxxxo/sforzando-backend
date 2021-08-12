<?php

namespace common\models;


use Yii;
use yii\web\UploadedFile;
use yii\db\Exception;
use common\helpers\ModelErrorHelper;

/**
 * This is the model class for table "judge".
 *
 * @property int $id
 * @property string $img_url
 *
 * @property JudgeLanguage[] $judgeLanguages
 * @property JudgeLanguage $judgeLanguage
 */
class Judge extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /** @var $default_fio string */
    /** @var $default_description string */
    public $default_fio, $default_description;

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
            [['img_url','default_fio','default_description'], 'string', 'max' => 255],
            [['imageFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                'maxSize' => 1024*1024*12
            ],

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
        return $this->hasMany(JudgeLanguage::className(), ['judge_id' => 'id'])->orderBy(['judge_language.language_id'=>SORT_ASC]);
    }

    public function getJudgeLanguage(){
        return $this->hasOne(JudgeLanguage::className(), ['judge_id' => 'id'])->onCondition(['language_id'=>Language::RUSSIAN]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert) {
            $languages = Language::find()->all();
            foreach ($languages as $language) {
                $model = (new JudgeLanguage([
                    'fio'=>$this->default_fio,
                    'description'=>$this->default_description,
                    'judge_id'=>$this->id,
                    'language_id'=>$language->id
                ]));
                if(!$model->save()){
                    throw new Exception(ModelErrorHelper::getModelErrorMessage($model));
                }
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}

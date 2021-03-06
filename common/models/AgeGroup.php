<?php

namespace common\models;

use common\helpers\ModelErrorHelper;
use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "age_group".
 *
 * @property int $id
 * @property int $full_years
 *
 * @property AgeGroupLanguage[] $ageGroupLanguages
 * @property CompetitionAgeGroups[] $competitionAgeGroups
 */
class AgeGroup extends \yii\db\ActiveRecord
{
    public $default_name = "";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['full_years','integer'],
            ['default_name','string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[AgeGroupLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgeGroupLanguages()
    {
        return $this->hasMany(AgeGroupLanguage::className(), ['age_group_id' => 'id'])->orderBy(['language_id'=>SORT_ASC]);
    }

    public function getAgeGroupLanguage(){
        return $this->hasOne(AgeGroupLanguage::className(), ['age_group_id' => 'id'])
            ->onCondition(['language_id'=>Language::RUSSIAN])
            ;
    }


    /**
     * Gets query for [[CompetitionAgeGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitionAgeGroups()
    {
        return $this->hasMany(CompetitionAgeGroups::className(), ['age_group_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert) {
            $languages = Language::find()->all();
            foreach ($languages as $language) {
                $model = (new AgeGroupLanguage([
                    'name'=>$this->default_name,
                    'age_group_id'=>$this->id,
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

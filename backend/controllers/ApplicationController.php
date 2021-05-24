<?php

namespace backend\controllers;

use backend\models\form\ApplicationForm;
use common\helpers\ModelErrorHelper;
use common\models\AgeGroup;
use common\models\Application;
use common\models\Competition;
use common\models\GalleryFile;
use common\models\GalleryFolder;
use common\models\Judge;
use common\models\Language;
use common\models\Nomination;
use common\models\PerformanceType;
use Yii;
use yii\base\Exception;
use yii\rest\Controller;

/**
 * Site controller
 */
class ApplicationController extends Controller
{
    public function init()
    {
        parent::init(); //
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = NULL;
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to domains:
                    'Origin' => Yii::$app->params['frontendHosts'],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,                 // Cache (seconds),
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new ApplicationForm();
        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate()) {
                $application = new Application([
                    'competition_id' => $model->competition_id,
                    'amount_of_participants'=>$model->amountOfPatricipants,
                    'comment'=>$model->comment,
                    'concertmaster_fio'=>$model->concertMaester,
                    'concertmaster_email'=>$model->concertMaesterMail,
                    'concertmaster_phone'=>$model->concertMaesterPhone,
                    'city'=>$model->country,
                    'type_of_performance'=>$model->performance_type,
                    'form_of_performance'=>$model->formOfPerfomance,
                    'name'=>$model->name,
                    'school_name'=>$model->nameOfSchool,
                    'nomination'=>$model->nomination,
                    'parent_fio'=>$model->parents,
                    'parent_email'=>$model->parentsMail,
                    'parent_phone'=>$model->parentsPhone,
                    'phone'=>$model->phone,
                    'picked'=>$model->picked,
                    'teacher_fio'=>$model->teacher,
                    'teacher_email'=>$model->teacherMail,
                    'teacher_phone'=>$model->teacherPhone,
                    'content_url'=>$model->content_url,
                    'requisite'=>$model->requisite,
                    'contact_mail'=>$model->contactMail
                ]);
                if(!$application->save()){
                    throw new Exception("Save: ".ModelErrorHelper::getErrorMessage($application->errors));
                }
                return [
                    'status' => 'ok'
                ];
            } else {
                throw new Exception("Validation: ".ModelErrorHelper::getErrorMessage($model->errors));
            }
        } else {
            throw new Exception('Отсутсвуют входящие параметры');
        }
    }


    public function actionGetForm($id,$lang = "ru"){
        $language = Language::findOne(['i18_name'=>$lang]);
        $competition = Competition::findOne(['id'=>$id]);
        if(!$language) {
            throw new \yii\db\Exception("Unknown language");
        }
        if(!$competition) {
            throw new \yii\db\Exception("Unknown competition");
        }

        return [
            'nominations'=>Nomination::find()
                ->select([
                    'nomination.id',
                    'nomination_language.name'
                ])
                ->leftJoin('nomination_language','nomination_language.nomination_id = nomination.id')
                ->where([
                    'language_id'=>$language->id
                ])
                ->orderBy([
                    'nomination_language.name'=>SORT_ASC
                ])
                ->asArray()
                ->all(),
            'age_groups'=>AgeGroup::find()
                ->select([
                    'age_group.id',
                    'age_group.full_years',
                    'age_group_language.name'
                ])
                ->leftJoin('age_group_language','age_group_language.age_group_id = age_group.id')
                ->where([
                    'language_id'=>$language->id
                ])
                ->orderBy([
                    'age_group.full_years'=>SORT_ASC,
                    'age_group_language.name'=>SORT_ASC
                ])
                ->asArray()
                ->all(),
            'performance_types'=>PerformanceType::find()
                ->select([
                    'performance_type.id',
                    'performance_type_language.name'
                ])
                ->leftJoin('performance_type_language','performance_type_language.performance_type_id = performance_type.id')
                ->where([
                    'language_id'=>$language->id
                ])
                ->orderBy([
                    'performance_type_language.name'=>SORT_ASC
                ])
                ->asArray()
                ->all(),
            'competition'=>Competition::find()
                ->select([
                    'competition.id',
                    'competition.start_date',
                    'competition_language.title',
                    'competition_language.text'
                ])
                ->leftJoin('competition_language','competition_language.competition_id = competition.id')
                ->where([
                    'language_id'=>$language->id
                ])
                ->asArray()
                ->one()
        ];
    }
}

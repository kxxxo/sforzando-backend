<?php

namespace backend\controllers;

use backend\models\form\ApplicationForm;
use common\helpers\ModelErrorHelper;
use common\models\Application;
use common\models\Competition;
use common\models\Judge;
use Yii;
use yii\base\Exception;
use yii\rest\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
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
                    'Origin' => [
                        'http://localhost:3000',
                        'http://sforzando-frontend.kxxo.ru',
                        'https://sforzando-frontend.kxxo.ru',
                    ],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,                 // Cache (seconds),
                ],
            ],
        ];
    }


    public function actionGetCompetitions($page = 1, $count = 3, $result = null)
    {
        $data = Competition::find()
            ->with(['competitionLanguages'])
            ->orderBy(['start_date' => SORT_DESC])
            ->limit($count)
            ->offset(($page - 1) * $count);
        if (!is_null($result)) {
            $data->andWhere([
                'AND',
                ['competition.is_ended' => $result],
                ['IS NOT', 'competition.result_url', null]
            ]);
        }

        return $data->asArray()
            ->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetJudges()
    {
        return Judge::find()
            ->with(['judgeLanguages'])
            ->orderBy(['id' => SORT_ASC])
            ->asArray()
            ->all();
    }

    public function actionCreateApplication()
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
                    'type_of_performance'=>$model->employment,
                    'form_of_performance'=>$model->formOfPerfomance,
                    'full_age'=>$model->fullAge,
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
                    'teacher_phone'=>$model->teacherPhone
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
}

<?php

namespace backend\controllers;

use backend\models\form\ApplicationForm;
use common\helpers\ModelErrorHelper;
use common\models\Application;
use common\models\Competition;
use common\models\GalleryFile;
use common\models\GalleryFolder;
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
                        'http://sforzando-frontend.kxxo.ru:4001'
                    ],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,                 // Cache (seconds),
                ],
            ],
        ];
    }

    public function actionGetYandexGeo($part){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://suggest-maps.yandex.ru/suggest-geo?v=5&search_type=tp&part=".$part."&lang=ru_RU&n=5&origin=jsapi2Geocoder&bbox=-180%2C-90%2C180%2C90",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 89dcd494-0f82-e5cf-c881-71572034a0df"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
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

    public function actionGetGallery($path){
        $folder = GalleryFolder::findOne([
            'original_path'=>$path
        ]);
        if($folder) {
            return [
                'info' => [
                    'id'=>$folder->id,
                    'name'=>$folder->name,
                    'path'=>$folder->original_path
                ],
                'folders' => GalleryFolder::find()
                    ->where(['parent_id'=>$folder->id])
                    ->orderBy(['id'=>SORT_ASC])
                    ->asArray()
                    ->all(),
                'items' => GalleryFile::find()
                    ->where(['gallery_folder_id'=>$folder->id])
                    ->orderBy(['id'=>SORT_ASC])
                    ->asArray()
                    ->all()
            ];
        }
        return [];
    }
}

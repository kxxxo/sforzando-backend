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
                    'Origin' => Yii::$app->params['frontendHosts'],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,                 // Cache (seconds),
                ],
            ],
        ];
    }

    public function actionGetCompetitions($page = 1, $count = 3, $result = null, $lang = 'ru')
    {
        $data = Competition::find()
            ->select([
                'id'=>'competition.id',
                'contact_mail',
                'create_datetime',
                'start_date',
                'end_date',
                'img_url',
                'is_ended',
                'request_end_datetime',
                'result_url',
                'rules_file_url',
                'title'=>'competition_language.title',
                'text'=>'competition_language.text'
            ])
            ->leftJoin('competition_language','competition_language.competition_id = competition.id')
            ->leftJoin('language','language.id = competition_language.language_id')
            ->orderBy(['start_date' => SORT_DESC])
            ->limit($count)
            ->offset(($page - 1) * $count)
            ->where([
                'language.i18_name'=>$lang
            ])
        ;
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
    public function actionGetJudges($lang = 'ru')
    {
        return Judge::find()
            ->select([
                'id'=>'judge.id',
                'img_url',
                'fio'=>'judge_language.fio',
                'description'=>'judge_language.description',
            ])
            ->leftJoin('judge_language','judge_language.judge_id = judge.id')
            ->leftJoin('language','language.id = judge_language.language_id')
            ->where([
                'language.i18_name'=>$lang
            ])
            ->orderBy(['id' => SORT_ASC])
            ->asArray()
            ->all();
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

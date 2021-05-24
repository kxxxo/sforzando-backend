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

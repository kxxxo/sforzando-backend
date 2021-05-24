<?php

namespace console\controllers;

use Arhitector\Yandex\Disk;
use common\helpers\ModelErrorHelper;
use common\models\AgeGroup;
use common\models\GalleryFile;
use common\models\GalleryFolder;
use common\models\Language;
use common\models\Nomination;
use common\models\NominationLanguage;
use common\models\PerformanceType;
use yii\db\Exception;
use yii\httpclient\Client;
use yii\console\Controller;

class SeedController extends Controller
{

    public function actionIndex()
    {
        $this->actionSeedNominations();
    }

    public function actionSeedNominations()
    {
        $data = [
            ['Фортепиано'],
            ['Композиция'],
            ['Современная хореография'],
            ['Художественное слово'],
            ['Театр'],
            ['Вокал'],
        ];

        foreach ($data as $item){
            $model = (new Nomination());
            $model->default_name = $item[0];
            if($model->save()){
                echo $model->id." saved \n";
            } else {
                throw new Exception(ModelErrorHelper::getModelErrorMessage($model));
            }
        }
    }


    public function actionSeedPerformanceTypes()
    {
        $data = [
            ['Очная'],
            ['Заочная']
        ];

        foreach ($data as $item){
            $model = (new PerformanceType());
            $model->default_name = $item[0];
            if($model->save()){
                echo $model->id." saved \n";
            } else {
                throw new Exception(ModelErrorHelper::getModelErrorMessage($model));
            }
        }
    }

    public function actionSeedAgeGroups()
    {
        $data = [
            ['Младшая группа А',7],
            ['Средняя группа Б',13]
        ];
        foreach ($data as $item){
            $model = (new AgeGroup());
            $model->default_name = $item[0];
            $model->full_years = $item[1];

            if($model->save()){
                echo $model->id." saved \n";
            } else {
                throw new Exception(ModelErrorHelper::getModelErrorMessage($model));
            }
        }

    }
}

<?php

namespace frontend\controllers;

use common\helpers\ModelErrorHelper;
use common\models\AgeGroup;
use common\models\AgeGroupLanguage;
use common\models\CompetitionLanguage;
use common\models\JudgeLanguage;
use common\models\Nomination;
use common\models\NominationLanguage;
use Yii;
use common\models\Competition;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Class NominationController
 * @package frontend\controllers
 */
class AgeGroupController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Competition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AgeGroup::find()->joinWith(['ageGroupLanguage'])->orderBy(['age_group.id'=>SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Competition model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Competition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AgeGroup();

        if ($model->load(Yii::$app->request->post())){
//            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
//            if($model->imageFile) {
//                $model->imageFile->saveAs('@backend/web/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension, false);
//                $model->img_url = '/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension;
//            }

            if(!$model->save()){
                throw new Exception(ModelErrorHelper::getModelErrorMessage($model));
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Competition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
//            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
//            if($model->imageFile) {
//                $model->imageFile->saveAs('@backend/web/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension, false);
//                $model->img_url = '/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension;
//            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdateLanguage($id)
    {
        $model = AgeGroupLanguage::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->age_group_id]);
        }

        return $this->render('update-language', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Competition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AgeGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AgeGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

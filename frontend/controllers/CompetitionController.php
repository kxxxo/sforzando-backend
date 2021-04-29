<?php

namespace frontend\controllers;

use common\helpers\ModelErrorHelper;
use common\models\CompetitionLanguage;
use common\models\JudgeLanguage;
use Yii;
use common\models\Competition;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompetitionController implements the CRUD actions for Competition model.
 */
class CompetitionController extends Controller
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
        ];
    }

    /**
     * Lists all Competition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Competition::find()->joinWith(['competitionLanguage'])->orderBy(['competition.start_date'=>SORT_DESC]),
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
        $model = new Competition();

        if ($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile) {
                $model->imageFile->saveAs('@backend/web/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension, false);
                $model->img_url = '/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension;
            }

            $model->resultFile = UploadedFile::getInstance($model, 'resultFile');
            if($model->resultFile) {
                $model->resultFile->saveAs('@backend/web/storage/results/' . $model->resultFile->baseName . '_' . date('U') . '.' . $model->resultFile->extension, false);
                $model->result_url = '/storage/results/' . $model->resultFile->baseName . '_' . date('U') . '.' . $model->resultFile->extension;
            }

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
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile) {
                $model->imageFile->saveAs('@backend/web/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension, false);
                $model->img_url = '/images/competition/' . $model->imageFile->baseName . '_' . date('U') . '.' . $model->imageFile->extension;
            }

            $model->resultFile = UploadedFile::getInstance($model, 'resultFile');
            if($model->resultFile) {
                $model->resultFile->saveAs('@backend/web/storage/results/' . $model->resultFile->baseName . '_' . date('U') . '.' . $model->resultFile->extension, false);
                $model->result_url = '/storage/results/' . $model->resultFile->baseName . '_' . date('U') . '.' . $model->resultFile->extension;
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Competition model.
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
        $model = CompetitionLanguage::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->competition_id]);
        }

        return $this->render('update-language', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Competition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Competition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Competition::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

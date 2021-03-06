<?php

namespace frontend\controllers;

use common\models\Competition;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use common\models\Application;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\csvgrid\CsvGrid;

/**
 * ApplicationController implements the CRUD actions for Application model.
 */
class ApplicationController extends Controller
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
                    'delete' => ['POST'],
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
     * @param $competition_id
     * @return string
     */
    public function actionIndex($competition_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Application::find()
                ->orderBy(['id'=>SORT_DESC])
                ->where(['competition_id'=>$competition_id])
            ,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'competition_id'=>$competition_id
        ]);
    }

    /**
     * Displays a single Application model.
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

    public function actionDownload($competition_id){
        $competition = Competition::findOne($competition_id);
        $applications = Application::find()
            ->where(['competition_id'=>$competition_id])
            ->all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = [
            'amount_of_participants' => '??????-???? ????????????????????',
            'comment' => '??????????????????????',
            'concertmaster_fio' => 'Concertmaster Fio',
            'concertmaster_phone' => 'Concertmaster Phone',
            'concertmaster_email' => 'Concertmaster Email',
            'city' => '??????????',
//            'type_of_performance' => '?????? ??????????????????????????',
            'name' => '??????',
            'school_name' => '??????????',
//            'nomination' => '??????????????????',
            'parent_fio' => '?????? ??????????????????',
            'parent_email' => '???????????????????????? Email',
            'parent_phone' => '???????????????????????? ??????????????',
            'phone' => '??????????????',
            'teacher_fio' => 'Teacher Fio',
//            'teacher_email' => 'Teacher Mail',
//            'teacher_phone' => 'Teacher Phone',
        ];

        $col = 65;
        $z = 0;
        foreach ($columns as $column){
            $sheet->setCellValue(chr($col+$z).'1', $column);
            $z++;
        }

        foreach ($applications as $i => $application) {
            $z = 0;
            foreach ($columns as $j=>$column) {
                $sheet->setCellValue(chr($col+$z).($i+2), $application->{$j});
                $z++;
            }
        }


        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$competition->competitionLanguage->title.'.xlsx"');
        $writer->save('php://output');
        die();
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Application model.
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

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

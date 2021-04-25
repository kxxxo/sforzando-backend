<?php
namespace backend\controllers;

use common\models\Competition;
use common\models\Instance;
use common\models\Language;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\BadRequestHttpException;
use yii\rest\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function init() {
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
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'      => ['http://localhost:3000'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds),
                ],
            ],
        ];
    }



    public function actionGetCompetitions($page = 1, $count = 3)
    {
        return Competition::find()
            ->with(['competitionLanguages'])
            ->orderBy(['start_datetime'=>SORT_DESC])
            ->limit($count)
            ->offset(($page-1)*$count)
            ->asArray()
            ->all();
    }

}

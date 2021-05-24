<?php
namespace backend\models\form;

use common\models\AgeGroup;
use common\models\Competition;
use common\models\Nomination;
use common\models\PerformanceType;
use yii\base\Exception;
use yii\base\Model;
use common\models\User;


class ApplicationForm extends Model
{
    public $amountOfPatricipants; //: 244
    public $comment;
    public $concertMaester;
    public $concertMaesterMail;
    public $concertMaesterPhone;
    public $country;
    public $performance_type;
    public $formOfPerfomance;
    public $ageGroup;
    public $name;
    public $nameOfSchool;
    public $nomination;
    public $parents;
    public $parentsMail;
    public $parentsPhone;
    public $phone;
    public $picked;
    public $teacher;
    public $teacherMail;
    public $teacherPhone;
    public $competition_id;
    public $requisite;
    public $contactMail;
    public $content_url;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nameOfSchool', 'country','teacherPhone','phone','teacher','performance_type','amountOfPatricipants','nomination','ageGroup','formOfPerfomance','teacherMail','competition_id','contactMail'], 'required'],
            [['name', 'nameOfSchool', 'country','teacherPhone','phone','teacher', 'formOfPerfomance','teacherMail','picked','concertMaester','concertMaesterPhone',
                'concertMaesterMail','parents','parentsPhone','comment','requisite','content_url'
            ], 'string'],
            ['amountOfPatricipants','safe'],
            [['teacherMail','parentsMail','contactMail'], 'email'],
            [
                ['competition_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Competition::className(),
                'targetAttribute' => ['competition_id' => 'id'],
            ],
            [
                ['nomination'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Nomination::className(),
                'targetAttribute' => ['nomination' => 'id'],
            ],
            [
                ['ageGroup'],
                'exist',
                'skipOnError' => true,
                'targetClass' => AgeGroup::className(),
                'targetAttribute' => ['ageGroup' => 'id'],
            ],
            [
                ['performance_type'],
                'exist',
                'skipOnError' => true,
                'targetClass' => PerformanceType::className(),
                'targetAttribute' => ['performance_type' => 'id'],
            ],
        ];
    }
}


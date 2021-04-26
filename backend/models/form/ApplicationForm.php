<?php
namespace backend\models\form;

use common\models\Competition;
use common\models\Country;
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
    public $employment;
    public $formOfPerfomance;
    public $fullAge;
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nameOfSchool', 'country','teacherPhone','phone','teacher','employment','amountOfPatricipants','nomination','fullAge','formOfPerfomance','teacherMail','competition_id'], 'required'],
            [['name', 'nameOfSchool', 'country','teacherPhone','phone','teacher','employment',
                'nomination','fullAge','formOfPerfomance','teacherMail','picked','concertMaester','concertMaesterPhone',
                'concertMaesterMail','parents','parentsPhone','comment'
            ], 'string'],
            ['amountOfPatricipants','safe'],
            [['teacherMail','parentsMail'], 'email'],
            [
                ['competition_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Competition::className(),
                'targetAttribute' => ['competition_id' => 'id'],
            ],
        ];
    }
}


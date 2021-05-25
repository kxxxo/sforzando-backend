<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $competition_id
 * @property int $amount_of_participants
 * @property string|null $comment
 * @property string|null $concertmaster_fio
 * @property string|null $concertmaster_phone
 * @property string|null $concertmaster_email
 * @property string $city
 * @property string $type_of_performance
 * @property string $form_of_performance
 * @property string $name
 * @property string $school_name
 * @property string $nomination
 * @property string|null $parent_fio
 * @property string|null $parent_email
 * @property string|null $parent_phone
 * @property string|null $phone
 * @property string|null $picked
 * @property string|null $teacher_fio
 * @property string $teacher_email
 * @property string $teacher_phone
 * @property string $requisite;
 * @property string $contact_mail;
 * @property string $content_url;
 *
 * @property Competition $competition
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competition_id', 'amount_of_participants', 'city','form_of_performance', 'name', 'school_name', 'nomination', 'teacher_email', 'teacher_phone'], 'required'],
            [['competition_id', 'amount_of_participants'], 'default', 'value' => null],
            [['competition_id', 'amount_of_participants','nomination','type_of_performance'], 'integer'],
            [['comment', 'name', 'school_name','form_of_performance','contact_mail','requisite','content_url'], 'string'],
            [['concertmaster_fio', 'concertmaster_phone', 'concertmaster_email', 'city', 'parent_fio', 'parent_email', 'parent_phone', 'phone', 'picked', 'teacher_fio', 'teacher_email', 'teacher_phone'], 'string', 'max' => 255],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competition::className(), 'targetAttribute' => ['competition_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'competition_id' => 'Competition ID',
            'amount_of_participants' => 'Amount Of Participants',
            'comment' => 'Comment',
            'concertmaster_fio' => 'Concertmaster Fio',
            'concertmaster_phone' => 'Concertmaster Phone',
            'concertmaster_email' => 'Concertmaster Email',
            'city' => 'City',
            'type_of_performance' => 'Type Of Performance',
            'name' => 'Name',
            'school_name' => 'School Name',
            'nomination' => 'Nomination',
            'parent_fio' => 'Parent Fio',
            'parent_email' => 'Parent Email',
            'parent_phone' => 'Parent Phone',
            'phone' => 'Phone',
            'picked' => 'Picked',
            'teacher_fio' => 'Teacher Fio',
            'teacher_email' => 'Teacher Mail',
            'teacher_phone' => 'Teacher Phone',
        ];
    }

    /**
     * Gets query for [[Competition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition()
    {
        return $this->hasOne(Competition::className(), ['id' => 'competition_id']);
    }

    public function sendToMail(){
        Yii::info("Sending email successfull: ". Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($this->competition->contact_mail)
            ->setSubject('New application!!!')
//            ->setTextBody('Plain text content')
            ->setHtmlBody(print_r($this->attributes(),1))
            ->send());
    }
}

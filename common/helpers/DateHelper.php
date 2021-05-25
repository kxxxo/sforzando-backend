<?php
namespace common\helpers;
use yii\caching\TagDependency;

class DateHelper {

    const
        FORMAT = 'dd.MM.yyyy HH:mm',
        SQL_FORMAT = 'yyyy-MM-dd HH:mm:ss',
        DAY_FORMAT = 'yyyy-MM-dd';

	const SERVER_DATETIME_FORMAT = "Y-m-d H:i:s";
	const SERVER_DATE_FORMAT = "Y-m-d";
    const CLIENT_DATE_FORMAT = "d.m.Y H:i";
    const CLIENT_DAY_FORMAT = "d.m.Y";

	const UTC = "UTC";
	const LOCAL = 'local';


    public static function convertToDayFormat($dateTime){
        return \Yii::$app->getFormatter()->asDate($dateTime, self::DAY_FORMAT);
    }


}

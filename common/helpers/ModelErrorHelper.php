<?php
namespace common\helpers;


use Yii;
use yii\base\Model;
use yii\db\Transaction;
use yii\web\Controller;
use yii\web\View;

class ModelErrorHelper
{
    /**
     * Возвращает ошибки в виде строки через запятую
     * @param $arg array
     * @return string
     */
    public static function getErrorMessage($arg,$model = null)
    {
        $data = [];
        foreach ($arg as $i=>$error_array){
            foreach ($error_array as $error){
                /** @var $model Model*/
                $data[] =
                    $model
                        ? $model->getAttributeLabel($i). ': '.$error
                        : $error;
            }
        }
        return implode(', ',$data);
    }


    /**
     * Тоже самое что и @see getErrorMessage , только проще
     * @param $model Model
     *
     * @return string
     */
    public static function getModelErrorMessage($model){
        return self::getErrorMessage($model->errors,$model);
    }

    /**
     * Запись в сессию ошибки и редирект. И если нужно rollBack транзацкии + вывод причины ошибки в дебаг
     * @param string $flashKey
     * @param string $message
     * @param string|null $reason
     * @param Transaction|null $transaction
     * @param Controller| $controller
     * @param array|string $redirect
     * @return \yii\web\Response
     */
    public static function customFlash($flashKey, $message, Controller $controller,$redirect,$reason = null,Transaction $transaction = null)
    {
        Yii::$app->session->setFlash($flashKey, $message);
        if ($reason)
            Yii::warning(print_r($reason, 1));
        if ($transaction)
            $transaction->rollBack();
        return $controller->redirect($redirect);
    }
}

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Competition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competition-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'request_end_datetime')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'start_date')->textInput(['type' => 'date']) ?>

    <?
        if($model->img_url) {
            echo Html::img(Yii::$app->params['backendUrl'] . $model->img_url, [
                'width' => 250,
                'height' => 250
            ]);
        }
    ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'is_ended')->checkbox() ?>

    <?
        if($model->result_url) {
            echo Html::a(Yii::$app->params['backendUrl'].$model->result_url,Yii::$app->params['backendUrl'].$model->result_url);
        }
    ?>
    <?= $form->field($model, 'resultFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

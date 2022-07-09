<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Judge */
?>

<div class="judge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if($model->isNewRecord) {
        echo $form->field($model, 'default_fio')->textInput();
        echo $form->field($model, 'default_description')->widget(\mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);
    }
    ?>
    <?= $form->field($model, 'pos')->textInput(['type' => 'number']) ?>
    <?php if($model->img_url){
            echo Html::img(Yii::$app->params['backendUrl'].$model->img_url,[
                'width'=>250,
                'height'=>250
            ]);
        }
    ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

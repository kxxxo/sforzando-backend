<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JudgeLanguage */

$this->title = 'Update Judge Language: ' . $model->language->name;
$this->params['breadcrumbs'][] = ['label' => 'Judges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="judge-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="judge-form">

        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model, 'fio')->textInput() ?>
        <?= $form->field($model, 'description')->widget(\mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>


</div>

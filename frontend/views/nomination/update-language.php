<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NominationLanguage */

$this->title = 'Update Nomination Language: ' . $model->language->name;
$this->params['breadcrumbs'][] = ['label' => 'Nominations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomination-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="nomination-form">

        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>


</div>

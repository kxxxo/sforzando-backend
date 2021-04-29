<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Application */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'competition_id')->textInput() ?>

    <?= $form->field($model, 'amount_of_participants')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'concertmaster_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concertmaster_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concertmaster_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_of_performance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_of_performance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_age')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'school_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nomination')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picked')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

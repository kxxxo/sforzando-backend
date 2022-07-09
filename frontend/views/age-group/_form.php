<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Nomination */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competition-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php if($model->isNewRecord) {
        echo $form->field($model, 'default_name')->textInput();
    } ?>

    <?= $form->field($model, 'full_years')->textInput([
        'type'=>'number',
        'min'=>0,
        'max'=>999
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

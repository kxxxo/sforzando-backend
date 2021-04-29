<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Judge */
?>

<div class="judge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?if($model->img_url){
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

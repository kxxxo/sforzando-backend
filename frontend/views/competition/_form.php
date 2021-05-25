<?php

use common\models\CompetitionAgeGroups;
use common\models\CompetitionNominations;
use common\models\CompetitionPerformanceTypes;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\helpers\DateHelper;
use kartik\select2\Select2;
use common\models\Nomination;
use common\models\PerformanceType;
use common\models\AgeGroup;
/* @var $this yii\web\View */
/* @var $model common\models\Competition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competition-form">
    <?php $form = ActiveForm::begin(); ?>

    <?
     if($model->isNewRecord) {
         echo $form->field($model, 'default_title')->textInput();
         echo $form->field($model, 'default_text')->widget(\mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);
     }
    ?>

    <? $model->performance_types = CompetitionPerformanceTypes::find()->select('performance_type_id')
        ->where(['competition_id'=>$model->id])->column() ?>
    <?= $form->field($model, 'performance_types')->widget(Select2::classname(), [
        'options' => [ 'multiple' => true],
        'data'=>ArrayHelper::map(PerformanceType::find()
            ->asArray()
            ->select(['performance_type.id','name'])
            ->joinWith('performanceTypeLanguage')
            ->orderBy('name')
            ->all(), 'id','name'),
        'pluginOptions'=>[
            'closeOnSelect'=>false,
            'allowClear' => false,
        ]
    ]); ?>
    <? $model->age_groups = CompetitionAgeGroups::find()->select('age_group_id')
        ->where(['competition_id'=>$model->id])->column() ?>
    <?= $form->field($model, 'age_groups')->widget(Select2::class, [
        'options' => [ 'multiple' => true],
        'data'=>ArrayHelper::map(AgeGroup::find()
            ->asArray()
            ->select(['age_group.id','name'])
            ->joinWith('ageGroupLanguage')
            ->orderBy('name')
            ->all(), 'id','name'),
        'pluginOptions'=>[
            'closeOnSelect'=>false,
            'allowClear' => false,
        ]
    ]); ?>
    <? $model->nominations = CompetitionNominations::find()->select('nomination_id')
        ->where(['competition_id'=>$model->id])->column() ?>
    <?= $form->field($model, 'nominations')->widget(Select2::class, [
        'data'=>ArrayHelper::map(Nomination::find()
            ->asArray()
            ->select(['nomination.id','name'])
            ->joinWith('nominationLanguage')
            ->orderBy('name')
            ->all(), 'id','name'),
        'options' => [ 'multiple' => true],
        'pluginOptions'=>[
            'closeOnSelect'=>false,
            'allowClear' => false,
        ]
    ]) ?>

    <?
        if(!$model->isNewRecord) {
            $model->request_end_datetime = \Yii::$app->getFormatter()->asDate($model->request_end_datetime, DateHelper::DAY_FORMAT);
        }
        echo $form->field($model, 'request_end_datetime')->widget(DatePicker::class,[
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);
    ?>

    <div class="row">
        <div class="col-md-6">
            <?
            if(!$model->isNewRecord) {
                $model->start_date = \Yii::$app->getFormatter()->asDate($model->start_date, DateHelper::DAY_FORMAT);
            }
            echo $form->field($model, 'start_date')->widget(DatePicker::class,[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?
            if(!$model->isNewRecord) {
                $model->end_date = \Yii::$app->getFormatter()->asDate($model->end_date, DateHelper::DAY_FORMAT);
            }
            echo $form->field($model, 'end_date')->widget(DatePicker::class,[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
    </div>

    <?= $form->field($model, 'contact_mail')->textInput() ?>

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

    <?
    if($model->rules_file_url) {
        echo Html::a(Yii::$app->params['backendUrl'].$model->rules_file_url,Yii::$app->params['backendUrl'].$model->rules_file_url);
    }
    ?>
    <?= $form->field($model, 'rulesFile')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

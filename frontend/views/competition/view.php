<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Competition */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="competition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Applications', ['/application/index', 'competition_id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'create_datetime',
            'request_end_datetime',
            'start_date',
            [
                'attribute'=>'img_url',
                'value'=>
                    Yii::$app->params['backendUrl'].$model->img_url
                ,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'is_ended:boolean',
            [
                'attribute'=>'result_url',
                'value'=> function($model){
                    if($model->result_url) {
                        return Yii::$app->params['backendUrl'] . $model->result_url;
                    }
                },
                'format' => 'url',
            ],
            [
                'attribute'=>'rules_file_url',
                'value'=> function($model){
                    if($model->rules_file_url) {
                        return Yii::$app->params['backendUrl'] . $model->rules_file_url;
                    }
                },
                'format' => 'url',
            ]
        ],
    ]) ?>

    <?php
    foreach ($model->competitionLanguages as $competitionLanguage) {
        echo Html::tag('h5',$competitionLanguage->language->name);
        echo DetailView::widget([
            'model' => $competitionLanguage,
            'attributes' => [
                'title',
                'text:html',
            ],
        ]);
        echo Html::a('Update ', ['update-language', 'id' => $competitionLanguage->id], ['class' => 'btn btn-primary'])."<br><br>";
    }

    ?>




</div>

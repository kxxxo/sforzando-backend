<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Judge */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Judges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="judge-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'pos',
            [
                'attribute'=>'img_url',
                'value'=>
                    Yii::$app->params['backendUrl'].$model->img_url
                ,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
        ],
    ]) ?>

    <?php
        foreach ($model->judgeLanguages as $judgeLanguage) {
            echo Html::tag('h5',$judgeLanguage->language->name);
            echo DetailView::widget([
                'model' => $judgeLanguage,
                'attributes' => [
                    'fio',
                    'description:html',
                ],
            ]);
            echo Html::a('Update ', ['update-language', 'id' => $judgeLanguage->id], ['class' => 'btn btn-primary'])."<br><br>";
        }

    ?>


</div>

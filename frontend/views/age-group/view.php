<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AgeGroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'AgeGroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="competition-view">

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
            'full_years'
        ],
    ]) ?>

    <?php
    foreach ($model->ageGroupLanguages as $ageGroupLanguage) {
        echo Html::tag('h5',$ageGroupLanguage->language->name);
        echo DetailView::widget([
            'model' => $ageGroupLanguage,
            'attributes' => [
                'name',
            ],
        ]);
        echo Html::a('Update ', ['update-language', 'id' => $ageGroupLanguage->id], ['class' => 'btn btn-primary'])."<br><br>";
    }

    ?>




</div>

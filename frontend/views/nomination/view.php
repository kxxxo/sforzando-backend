<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Nomination */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nominations', 'url' => ['index']];
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
            'id'
        ],
    ]) ?>

    <?php
    foreach ($model->nominationLanguages as $nominationLanguage) {
        echo Html::tag('h5',$nominationLanguage->language->name);
        echo DetailView::widget([
            'model' => $nominationLanguage,
            'attributes' => [
                'name',
            ],
        ]);
        echo Html::a('Update ', ['update-language', 'id' => $nominationLanguage->id], ['class' => 'btn btn-primary'])."<br><br>";
    }

    ?>




</div>

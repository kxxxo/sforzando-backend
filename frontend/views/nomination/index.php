<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nomination';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomination-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Nomination', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nominationLanguage.name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}'
            ],
        ],
    ]); ?>


</div>

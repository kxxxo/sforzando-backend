<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $competition_id int */

$this->title = 'Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Download', ['download','competition_id'=>$competition_id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name:ntext',

            'full_age',
            'phone',
            'school_name:ntext',
            'parent_fio',

            'amount_of_participants',
//            'comment:ntext',
//            'concertmaster_fio',
            //'concertmaster_phone',
            //'concertmaster_email:email',
            //'city',
            //'type_of_performance',
            //'form_of_performance',

            //'nomination:ntext',
            //'parent_email:email',
            //'parent_phone',

            //'picked',
            //'teacher_fio',
            //'teacher_email:email',
            //'teacher_phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

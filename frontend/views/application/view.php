<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => [
    'index',
    'competition_id' => $model->competition_id
]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

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
            'competition_id',
            'amount_of_participants',
            'comment:ntext',
            'concertmaster_fio',
            'concertmaster_phone',
            'concertmaster_email:email',
            'city',
            'type_of_performance',
            'form_of_performance',
            'full_age',
            'name:ntext',
            'school_name:ntext',
            'nomination:ntext',
            'parent_fio',
            'parent_email:email',
            'parent_phone',
            'phone',
            'picked',
            'teacher_fio',
            'teacher_email:email',
            'teacher_phone',
        ],
    ]) ?>

</div>

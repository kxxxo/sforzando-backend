<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Judge */

$this->title = 'Create Judge';
$this->params['breadcrumbs'][] = ['label' => 'Judges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Nomination */

$this->title = 'Create Nomination';
$this->params['breadcrumbs'][] = ['label' => 'Nomination', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomination-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

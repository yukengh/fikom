<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengampu */

$this->title = 'Update Pengampu: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengampus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengampu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

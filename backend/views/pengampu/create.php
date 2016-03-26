<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pengampu */

$this->title = 'Create Pengampu';
$this->params['breadcrumbs'][] = ['label' => 'Pengampus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengampu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

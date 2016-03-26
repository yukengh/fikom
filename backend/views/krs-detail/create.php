<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KrsdnsDetail */

$this->title = 'Create Krsdns Detail';
$this->params['breadcrumbs'][] = ['label' => 'Krsdns', 'url' => ['krs/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

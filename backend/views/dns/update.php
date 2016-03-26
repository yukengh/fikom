<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'Update DNS';
$this->params['breadcrumbs'][] = ['label' => 'DNS', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="krsdns-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
        'modelsDnsDetail' => $modelsDnsDetail,
    ]) ?>

</div>

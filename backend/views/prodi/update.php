<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Prodi */

$this->title = 'Update Prodi: ' . ' ' . $model->nama_jenjang;
$this->params['breadcrumbs'][] = ['label' => 'Prodis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_jenjang, 'url' => ['view', 'id' => $model->nama_jenjang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prodi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

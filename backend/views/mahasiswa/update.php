<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mahasiswa */

$this->title = 'Update Mahasiswa: ' . ' ' . $model->npm;
$this->params['breadcrumbs'][] = ['label' => 'Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->npm, 'url' => ['view', 'id' => $model->npm]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mahasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

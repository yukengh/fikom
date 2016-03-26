<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Prodi */

$this->title = 'PROGRAM STUDI';
$this->params['breadcrumbs'][] = ['label' => 'Prodis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_jenjang',
            'kode',
        ],
    ]) ?>

</div>

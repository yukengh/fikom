<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'Create Krsdns';
$this->params['breadcrumbs'][] = ['label' => 'Krsdns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsKrsDetail' => $modelsKrsDetail,    
    ]) ?>

</div>

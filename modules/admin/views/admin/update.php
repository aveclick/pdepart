<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Отмена приказа: ' . $model->id;
?>
<div class="order-update">
    <?= Html::a('Назад', ['/admin'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

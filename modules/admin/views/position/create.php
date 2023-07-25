<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Добавить должность';
?>
<div class="position-create">
    <?= Html::a('Назад', ['/admin/position'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
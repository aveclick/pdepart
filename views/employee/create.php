<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Добавить сотрудника';
?>
<div class="employee-create">
    <?= Html::a('Назад', ['/employee'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

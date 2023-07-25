<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Time $model */

$this->title = 'Добавить';
?>
<div class="time-create">
<?= Html::a('Назад', ['/time'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

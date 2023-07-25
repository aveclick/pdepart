<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Time $model */

$this->title = 'Отразить уход сотрудника: ' . $model->employee_id;
?>
<div class="time-update">
<?= Html::a('Назад', ['/time'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>

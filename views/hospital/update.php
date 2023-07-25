<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hospital $model */

$this->title = 'Закрытие больничного №: ' . $model->id;
?>
<div class="hospital-update">
<?= Html::a('Назад', ['/hospital'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>

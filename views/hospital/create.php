<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hospital $model */

$this->title = 'Добавить';
?>
<div class="hospital-create">
<?= Html::a('Назад', ['/hospital'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

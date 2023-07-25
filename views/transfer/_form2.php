<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Position;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <? 
        $positions = Position::find()->all();
        $items = ArrayHelper::map($positions,'id','title');
        $params = [
                    'prompt' => 'Укажите должность'
                    ];
                    ?>

    <?= $form->field($model, 'position_id')->textInput()->dropDownList($items,$params) ?>

    <div class="form-group">
    <br>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

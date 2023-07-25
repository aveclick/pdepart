<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Hospital $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="hospital-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
            $employees = Employee::find()->all();
            $items = ArrayHelper::map($employees,'id','id');
            $params = [
                        'prompt' => 'Укажите табельный номер сотрудника'
                        ]; ?>
    
    <?= $form->field($model, 'employee_id')->dropDownList($items,$params) ?>

    <?= $form->field($model, 'start_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'end_date')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

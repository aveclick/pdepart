<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Time $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="time-form">

    <?php $form = ActiveForm::begin(); ?>
    <?
            $employees = Employee::find()->all();
            $items = ArrayHelper::map($employees,'id','id');
            $params = [
                        'prompt' => 'Укажите табельный номер сотрудника'
                        ]; ?>

    <?= $form->field($model, 'employee_id', ['enableAjaxValidation' => true])->dropDownList($items,$params) ?>


    <?= $form->field($model, 'coming_time')->textInput(['type' => 'time']) ?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

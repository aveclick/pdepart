<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <? 
        $departments = Department::find()->all();
        $items = ArrayHelper::map($departments,'id','title');
        $params = [
                    'prompt' => 'Укажите отдел'
                    ];
                    ?>

    <?= $form->field($model, 'department_id')->textInput()->dropDownList($items,$params) ?>

    <div class="form-group">
    <br>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

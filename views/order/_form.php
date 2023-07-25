<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use app\models\Type;
use app\models\Status;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <? 
        $employees = Employee::find()->all();
        $items = ArrayHelper::map($employees,'id','id');
        $params = [
                    'prompt' => 'Укажите табельный номер сотрудника'
                    ];
        $types = Type::find()->all();
        $items1 = ArrayHelper::map($types,'id','title');
        $params1 = [
                    'prompt' => 'Укажите тип приказа'
                    ];
                    ?>
    

    <?= $form->field($model, 'type_id')->dropDownList($items1,$params1) ?>



    <?= $form->field($model, 'employee_id')->dropDownList($items,$params) ?>

    <?= $form->field($model, 'start_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'end_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'note')->textInput() ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

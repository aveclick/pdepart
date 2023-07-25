<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Catalog $model */
/** @var yii\widgets\ActiveForm $form */
?>
    <div class="row">
        <div class="col-md-6">
            <dic class="vacation-search">
                <?php $form = ActiveForm::begin([
                    'action' => ['index2'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>
                 <?php 
                      $departments = Department::find()->all();
        $items = ArrayHelper::map($departments,'id','title');
        $params = [
                    'prompt' => 'Укажите отдел'
                    ];
                    $model = fn($model) => $model->employee;

                    
                    echo $form->field($model, 'department_id')->textInput()->dropDownList($items,$params);
                ?>
                <br>
                <br>
                <div class='vacation-find'>
                    <?= Html::submitButton('Найти', ['class' => 'btn btn-primary'])?>
                </div>
                <?php ActiveForm::end()?>
            </dic>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Html::a('Сбросить все', ['/vacation'], ['class' => 'btn btn-outline-secondary mt-3'])?>
        </div>
    </div>
    <br>

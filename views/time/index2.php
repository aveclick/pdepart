<?php

use app\models\Time;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\TimeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Статистика по рабочему времени';
?>
<div class="time-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?
     $form = ActiveForm::begin(); 
            $date = DatePicker::widget(['name' => 'date', 'value' => $value, 'dateFormat' => 'yyyy-MM-dd', 'options' => ['placeholder' => 'Выберите дату']]);
            echo $date;
            echo Html::submitButton('Показать', ['class' => 'btn btn-primary btn-find', 'name' => 'find-button']);  
        ActiveForm::end(); 
        echo Html::a('Очистить', ['/time/index2'], ['class' => 'btn btn-outline-danger']);
        echo '<br>';
        echo '<br>';
                if(!empty($_POST)){
            $current_date = $_POST['date'];
        }
        else{
            $current_date = date('Y-m-d');
        }
        echo "<h3>Дата: ".$current_date."</h3>";
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 
                'attribute' => 'employee_id',
                'label' => 'Табельный номер сотрудника',
            ],
                        [
                'label' => 'ФИО сотрудника',
                'value' => fn($model) => $model->employee->name . ' ' . $model->employee->surname . ' ' . $model->employee->patronymic,
            ],
            [ 
                'attribute' => 'coming_time',
                'label' => 'Время прихода',
            ],
            [ 
                'attribute' => 'leaving_time',
                'label' => 'Время ухода',
            ],

             [ 
                'value' => function($model){
                    if(!empty($model->leaving_time)){
                        return $model->leaving_time - $model->coming_time;
                    }
                    else{
                        return '0';
                    }
                },
                'label' => 'Всего часов',
            ],
        ],
    ]); ?>


</div>

<?php

use app\models\Time;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TimeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Учет рабочего времени';
?>
<div class="time-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        
    </p>
    <? $current_date = date('Y-m-d');?>
   <h3>Дата: <?= $current_date?></h3>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            [
                'label' => 'Действия',
                'value' => function($model){
                    if ( empty($model->leaving_time) ) {
                        return "<div class='admin-buttons'>" .
                        "<div class='admin-button'>" . Html::a('Отразить уход', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary', 'data-method'=>'post']) 
                        . "</div>"
                        . "</div>";
                    };

                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

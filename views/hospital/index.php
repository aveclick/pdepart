<?php

use app\models\Hospital;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\HospitalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Учет больничных без подтверждения';
?>
<div class="hospital-index">

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
                'attribute' => 'start_date',
                'label' => 'Дата открытия больничного',
            ],
            [ 
                'attribute' => 'end_date',
                'label' => 'Дата закрытия больничного',
            ],
            [
                'label' => 'Действия',
                'value' => function($model) use($hospitalstatuses) {
                    return "<div class='admin-buttons'>" . "<div class='admin-button'>" . Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary'])
                    . "</div>"
                    . ($hospitalstatuses[$model->hospitalstatus_id] == 'Открыт' 
                            ? "<div class='admin-button'>" . Html::a('Закрыть', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method'=>'post']) 
                                . "</div>" . "<div class='admin-button'>" . Html::a('Продлить', ['extand', 'id' => $model->id], ['class' => 'btn btn-outline-warning', 'data-method'=>'post']) 
                                . "</div>"
                            : '')
                    . "</div>";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Сотрудники';
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 
                'attribute' => 'id',
                'label' => 'Табельный номер',
            ],
            [ 
                'attribute' => 'name',
                'label' => 'Имя',
            ],
            [ 
                'attribute' => 'surname',
                'label' => 'Фамилия',
            ],
            [ 
                'attribute' => 'patronymic',
                'label' => 'Отчество',
            ],
            [
                'label' => 'Должность',
                'attribute' => 'position_id',
                'value' => fn($model) => $positions[$model->position_id],
                'filter' => $positions,  
            ],

            [
                'label' => 'Отдел',
                'attribute' => 'department_id',
                'value' => fn($model) => $departments[$model->department_id],
                'filter' => $departments,      
            ],
            [
                'label' => 'Действия',
                'value' => 
                function($model){
                    return "<div class='admin-buttons'>" . "<div class='admin-button'>" . Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary'])
                    . "</div>" . "<div class='admin-button'>" . Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-warning']) . "</div>"
                    . "</div>";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

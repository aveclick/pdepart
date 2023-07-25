<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Приказы';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить приказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'attribute' => 'date',
                'label' => 'Дата приказа',
            ],

            [
                'label' => 'Тип приказа',
                'attribute' => 'type_id',
                'value' => fn($model) => $types[$model->type_id],
                'filter' => $types,      
            ],

            [
                'label' => 'Статус приказа',
                'attribute' => 'status_id',
                'value' => fn($model) => $statuses[$model->status_id],
                'filter' => $statuses,      
            ],
            [
                'label' => 'Действия',
                'value' => function($model) use($statuses) {
                    return "<div class='admin-buttons'>" . "<div class='admin-button'>" . Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary'])
                    . "</div>"
                    . ($statuses[$model->status_id] == 'Новый' 
                            ? "<div class='admin-button'>" . Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method'=>'post']) 
                                . "</div>" 
                            : '')
                    . "</div>";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

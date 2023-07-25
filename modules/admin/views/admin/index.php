<?php

use app\models\Order;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Приказы';
?>
<div class="order-index">
<h2>Панель управления</h2>
<p>
        <?= Html::a('Управление должностями', ['/admin/position'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Управление отделами', ['/admin/department'], ['class' => 'btn btn-success']) ?>
    </p>

    <h3><?= Html::encode($this->title) ?></h3>

    
    <?php   ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           
            [ 
                'attribute' => 'employee_id',
                'value' => fn($model) => $model->employee->name . ' ' . $model->employee->surname . ' ' . $model->employee->patronymic,
                'label' => 'ФИО сотрудника',
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
                    return Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) 
                    . "<div>"
                    . ($statuses[$model->status_id] == 'Новый' 
                            ? "<div class='admin-buttons'>" . "<div class='admin-button'>" . Html::a('Отменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-danger']) 
                                . "</div>" . "<div class='admin-button'>" . Html::a('Подтвердить', ['apply', 'id' => $model->id], ['class' => 'btn btn-outline-success']) . "</div>" . "</div>"
                            : '')
                    . "</div>";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\VacationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Статистика по отпускам';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'label' => 'Дата и номер приказа',
                'value' => fn($model) => $model->date . '<br>' . '№' . $model->id,
                'format' => 'raw',
            ],
            [
                'attribute' => 'start_date',
                'label' => 'Дата начала отпуска',
            ],
            [
                'attribute' => 'end_date',
                'label' => 'Дата окончания отпуска',
            ],

        ],
    ]); ?>


</div>

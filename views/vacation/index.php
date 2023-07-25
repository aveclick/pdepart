<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\VacationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Учет отпусков';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <? $current_date = date('Y-m-d');?>
   <h3>Дата: <?= $current_date?></h3>

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

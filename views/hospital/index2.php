<?php

use app\models\Hospital;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\HospitalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Статистика по больничным';
?>
<div class="hospital-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute' => 'start_date',
                'label' => 'Дата открытия больничного',
            ],
            [ 
                'attribute' => 'end_date',
                'label' => 'Дата закрытия больничного',
            ],
            [ 
                'attribute' => 'sickleave_num',
                'label' => 'Номер больничного листа',
            ],
        ],
    ]); ?>


</div>

<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\TransferSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Переводы';
?>
<div class="employee-index">
<?= Html::a('Назад', ['/admin'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 
                'attribute' => 'id',
                'label' => 'Табельный номер сотрудника',
            ],
            [
                'label' => 'ФИО сотрудника',
                'value' => fn($model) => $model->name . ' ' . $model->surname . ' ' . $model->patronymic,
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
                    return "<div class='admin-buttons'>" . "<div class='admin-button'>" . Html::a('Сменить отдел', ['update1', 'id' => $model->id], ['class' => 'btn btn-outline-primary'])
                    . "</div>" . "<div class='admin-button'>" . Html::a('Сменить должность', ['update2', 'id' => $model->id], ['class' => 'btn btn-outline-warning']) . "</div>"
                    . "</div>";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>

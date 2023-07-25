<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Личное дело сотрудника: ' . $model->name . ' ' . $model->surname . ' ' . $model->patronymic;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

<?= Html::a('Назад', ['/employee'], ['class' => 'btn btn-danger']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'attribute' => 'date_of_birth',
                'label' => 'Дата рождения',
            ],
            [ 
                'attribute' => 'email',
                'label' => 'Email',
            ],
            [ 
                'attribute' => 'phone_num',
                'label' => 'Номер телефона',
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

        ],
    ]) ?>

</div>

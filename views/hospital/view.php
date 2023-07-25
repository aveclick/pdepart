<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Hospital $model */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
$columns = [
    [ 
        'attribute' => 'id',
        'label' => 'Номер больничного',
    ],
    [ 
        'attribute' => 'user_id',
        'value' => fn($model) => $model->employee->name . ' ' . $model->employee->surname . ' ' . $model->employee->patronymic,
        'label' => 'ФИО сотрудника',
    ],
    [ 
        'attribute' => 'start_date',
        'value' => fn($model) => $model->start_date . ' - ' . $model->end_date,
        'label' => 'Период нетрудоспособности',
    ],
    [
        'label' => 'Статус больничного',
        'attribute' => 'status_id',
        'value' => fn($model) => $hospitalstatuses[$model->hospitalstatus_id],    
    ],
    
];
if ( $model->hospitalstatus_id == '2') {
    $columns[] = [ 
    'attribute' => 'sickleave_num',
    'label' => 'Номер больничного листа',
    ]; 
}
?>

<div class="hospital-view">

<?= Html::a('Назад', ['/hospital'], ['class' => 'btn btn-danger']) ?>
    <h3>Больничный №<?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $columns
        ],
    ) ?>

</div>

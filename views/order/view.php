<?php

use app\models\User;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);


$columns = [
    [ 
        'attribute' => 'id',
        'label' => 'Номер приказа',
    ],
    [ 
        'attribute' => 'user_id',
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
    
];

if ( !empty($model->start_date) ) {
    $columns[] = [ 
    'attribute' => 'start_date',
    'label' => 'Дата вступления приказа в силу',
    
    ]; 
}

if ( !empty($model->end_date) ) {
    $columns[] = [ 
    'attribute' => 'end_date',
    'label' => 'Дата окончания действия приказа',
    
    ]; 
}

if ( !empty($model->note) ) {
    $columns[] = [ 
    'attribute' => 'note',
    'label' => 'Примечания',
    
    ]; 
}

if ( !empty($model->reason) ) {
    $columns[] = [ 
    'attribute' => 'reason',
    'label' => 'Причина отмены приказа',
    
    ]; 
}

?>
<div class="order-view">
    <?= Html::a('Назад', ['/order'], ['class' => 'btn btn-danger']) ?>
    <h3>Приказ №<?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $columns
        ],
    ) ?>

</div>

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $date
 * @property int $type_id
 * @property int $status_id
 * @property int $employee_id
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property Employee $employee
 * @property Status $status
 * @property Type $type
 */
class Order extends \yii\db\ActiveRecord
{
    const SCENARIO_DENY = 'deny';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'type_id', 'status_id', 'employee_id'], 'required'],
            [['date', 'start_date', 'end_date'], 'safe'],
            [['type_id', 'status_id', 'employee_id'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['reason'], 'string', 'max' => 255],
            [['reason'], 'required', 'on' => static::SCENARIO_DENY],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата приказа',
            'type_id' => 'Тип приказа',
            'status_id' => 'Статус приказа',
            'employee_id' => 'Табельный номер сотрудника',
            'start_date' => 'Дата вступления приказа в силу',
            'end_date' => 'Дата окончания действия приказа',
            'reason' => 'Причина отмены приказа',
            'note' => 'Примечания',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->isNewRecord) {
    //             $this->status_id = Status::getStatusId('Новый');
    //         }
    //         return true;
    //     }
    //     return false;
    // }
}

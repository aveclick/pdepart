<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hospital".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $start_date
 * @property string|null $end_date
 * @property int $sickleave_num
 * @property int $hospitalstatus_id
 *
 * @property Employee $employee
 * @property Hospitalstatus $hospitalstatus
 */
class Hospital extends \yii\db\ActiveRecord
{
    const SCENARIO_DENY = 'deny';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hospital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'start_date', 'end_date', 'hospitalstatus_id'], 'required'],
            [['employee_id', 'sickleave_num', 'hospitalstatus_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['sickleave_num'], 'unique'],
            [['sickleave_num'], 'required', 'on' => static::SCENARIO_DENY],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['hospitalstatus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospitalstatus::class, 'targetAttribute' => ['hospitalstatus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Табельный номер сотрудника',
            'start_date' => 'Дата открытия больничного',
            'end_date' => 'Дата закрытия больничного',
            'sickleave_num' => 'Номер больничного листа',
            'hospitalstatus_id' => 'Hospitalstatus ID',
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
     * Gets query for [[Hospitalstatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalstatus()
    {
        return $this->hasOne(Hospitalstatus::class, ['id' => 'hospitalstatus_id']);
    }
}

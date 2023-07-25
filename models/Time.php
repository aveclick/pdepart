<?php

namespace app\models;
use app\models\Order;
use app\models\Hospital;
use Yii;

/**
 * This is the model class for table "time".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $date
 * @property string|null $coming_time
 * @property string|null $leaving_time
 *
 * @property Employee $employee
 */
class Time extends \yii\db\ActiveRecord
{
    const SCENARIO_DENY = 'deny';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'date', 'coming_time'], 'required'],
            [['employee_id'], 'integer'],
            [['date', 'coming_time', 'leaving_time'], 'safe'],
            [['leaving_time'], 'required', 'on' => static::SCENARIO_DENY],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
            ['employee_id', 'unique', 'message' => 'Данный сотрудник уже внесен в табель'],
            ['employee_id', 'validateIsabsent'],
        ];
    }

    public function validateIsabsent()
    {
        $current_date = date('Y-m-d');
        $isonvacation = Order::find()
        ->where(['type_id' => '3'])
        ->andWhere(['status_id' => '2'])
        ->andWhere(['>', 'end_date', $current_date])
        ->andWhere(['employee_id' => $this->employee_id])
        ->one();
        if(!is_null($isonvacation)){
            $errorMsg= 'Данный сотрудник находится в отпуске';
            $this->addError('employee_id',$errorMsg);
        }
        $isonsickleave = Hospital::find()
        ->where(['hospitalstatus_id' => '1'])
        ->andWhere(['employee_id' => $this->employee_id])
        ->one();
        if(!is_null($isonsickleave)){
            $errorMsg2= 'Данный сотрудник находится на больничном';
            $this->addError('employee_id',$errorMsg2);
                }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Табельный номер сотрудника',
            'date' => 'Дата',
            'coming_time' => 'Время прихода',
            'leaving_time' => 'Время ухода',
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
}

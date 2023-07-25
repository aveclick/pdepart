<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hospitalstatus".
 *
 * @property int $id
 * @property string $title
 *
 * @property Hospital[] $hospitals
 */
class Hospitalstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hospitalstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Hospitals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHospitals()
    {
        return $this->hasMany(Hospital::class, ['hospitalstatus_id' => 'id']);
    }

    public static function getHospitalstatuses(){
        return static::find()  
        ->select('title')                      
        ->indexBy('id')
        ->column();
    }
    public static function getHospitalstatusId($hospitalstatus){
        return static::findOne(['title' => $hospitalstatus])->id;
    }
}

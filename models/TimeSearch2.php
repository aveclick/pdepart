<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Time;

/**
 * TimeSearch represents the model behind the search form of `app\models\Time`.
 */
class TimeSearch2 extends Time
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id'], 'integer'],
            [['date', 'coming_time', 'leaving_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
       if(!empty($_POST)){
            $current_date = $_POST['date'];
        }
        else{
            $current_date = date('Y-m-d');
        }
        $query = Time::find()
        ->where(['date' => $current_date]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'coming_time' => $this->coming_time,
            'leaving_time' => $this->leaving_time,
        ]);

        return $dataProvider;
    }
}

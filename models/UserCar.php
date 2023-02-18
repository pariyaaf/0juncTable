<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;


class UserCar extends ActiveRecord
{
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    public static function tableName() {
        return 'usercar';
    }

    public function scenarios():array {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INSERT] = ['name', 'lastname'];
        $scenarios[self::SCENARIO_UPDATE] = ['id','name', 'lastname'];
        return $scenarios;
    }

    public function rules(): array {
        return [
            [['user_id', 'car_id'], 'unique', 'targetAttribute' => ['user_id', 'car_id'],'message'=>'This record exists!'],
            [['user_id', 'car_id'], 'required'],
    ];

    }


    //home
    public function getUser() {
        return $this->hasOne(User::className(), ['id'=> 'user_id']);
    }
    public function getCar() {
        return $this->hasOne(Car::className(), ['id'=> 'car_id']);
    }

}

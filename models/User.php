<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;

//home
use app\models\UserCar;


class User extends ActiveRecord
{
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    public static function tableName() {
        return 'user';
    }

    public function scenarios():array {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INSERT] = ['name', 'lastname'];
        $scenarios[self::SCENARIO_UPDATE] = ['id','name', 'lastname'];
        return $scenarios;
    }

    public function rules(): array {
        return [
            [['name', 'lastname'], 'required'],
            ['name', 'unique','when'=>function($model) {
                return (User::find()
                ->where(['=', 'name', $this->name])->one()) != null 
                && (User::find()->where(['=', 'name', $this->name])->one())->id != $this->id;
            }],
    ];




    }
    //home
    public function getCar() {
        return $this->hasMany(Car::className(), ['id'=> 'car_id'])->viaTable('UserCar', ['user_id' => 'id']);
    }

}

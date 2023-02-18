<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use  yii\web\Session;

///
use app\models\User;

//home
use app\models\UserCar;


class Car extends ActiveRecord
{
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    public static function tableName() {
        return 'car';
    }

    public function scenarios():array {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INSERT] = ['name'];
        $scenarios[self::SCENARIO_UPDATE] = ['id','name'];
        return $scenarios;
    }

    public function rules(): array {
        return [
            ['name', 'required'],
            ['name', 'unique','when'=>function($model) {
                return (Car::find()
                ->where(['=', 'name', $this->name])->one()) != null 
                && (Car::find()->where(['=', 'name', $this->name])->one())->id != $this->id;
            }],
    ];

    }

    ///
    public function getUsers() {
        return $this->hasMany(User::className(), ['id'=> 'user_id'])->viaTable('UserCar', ['car_id' => 'id']);
    }
}
//https://www.yiiframework.com/wiki/851/yii2-gridview-sorting-and-searching-with-a-junction-table-columnmany-to-many-relationship
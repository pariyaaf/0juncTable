<?php

namespace app\models;
use yii\base\Model;


class Manage extends Model
{
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INSERT] = ['name', 'lastname'];
        $scenarios[self::SCENARIO_UPDATE] = ['id','name', 'lastname'];
        $scenarios[self::SCENARIO_UPDATE] = ['id'];


        return $scenarios;
    }

    public function rules()
    {
        return[
            [['name', 'lastname'], 'required', 'on' => self::SCENARIO_INSERT],
            [['id'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['id'], 'required', 'on' => self::SCENARIO_DELETE],



        ];
    }
} 


?>
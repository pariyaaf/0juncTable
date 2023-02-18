<?php
namespace app\models;

use app\models\UserCar;
use app\models\Car;
use app\models\User;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;


class UserCarSearch extends UserCar
{

    public $userName;
    public $carName;
    public function rules(): array
    {
        return [
            [['id', 'user_id','car_id'], 'safe'],
            //
            [[ 'userName','carName'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
    
        $query = UserCar::find();

        $query->innerJoinWith('user');
        $query->innerJoinWith('car');

        $query->orFilterWhere(['like', 'user.name', $this->user_id] );
        $query->orFilterWhere(['like', 'user.lastname', $this->user_id]);

        $query->andFilterWhere(['like', 'car.name', $this->car_id]);
        $query->andFilterWhere(['usercar.id' => $this->id]);


        $_SESSION['a'] = $query->all();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['id',],
                'defaultOrder' => ['id' => SORT_DESC]
            ],
                
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $provider;
    } 

    
}
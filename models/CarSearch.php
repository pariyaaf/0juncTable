<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class CarSearch extends User
{
    public function rules(): array
    {
        return [
            [['name', 'id'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        $query = Car::find();//->orderBy($this->name);
        $query->andFilterWhere(['like', 'car.name', $this->name]);
        $query->andFilterWhere(['car.id' => $this->id]);
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

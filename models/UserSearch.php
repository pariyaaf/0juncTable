<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
// <?= Yii::$app->session->getFlash('error'); 


class UserSearch extends User
{
    public function rules(): array
    {
        return [
            [['name', 'lastname', 'id'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider {
        $this->load($params);
        $query = User::find();//->orderBy($this->name);
        $query->andFilterWhere(['like', 'user.name', $this->name]);
        $query->andFilterWhere(['like', 'user.lastname', $this->lastname]);
        $query->andFilterWhere(['user.id' => $this->id]);
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

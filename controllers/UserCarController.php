<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserCar;
use app\models\User;
use app\models\Car;
use yii\helpers\ArrayHelper; // load classes
use app\models\UserCarSearch;
use yii\data\ActiveDataProvider;



class UsercarController extends Controller
{

    public function actionIndex()
    {
        $userCarSearch = new UserCarSearch();
        return $this->render('index', [
            'dataProvider' => $userCarSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $userCarSearch
        ]);
    }

    public function actionInsert()
    {
     $model = new UserCar();
     $Useritems=ArrayHelper::map(User::find()->all(),'id','name');
     $Caritems=ArrayHelper::map(Car::find()->all(),'id','name');
     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $data = Yii::$app->request->post();
        $model->user_id = $data["UserCar"]['user_id'];
        $model->car_id = $data["UserCar"]['car_id'];

        if ($model->save()) {
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['usercar/index']);
        }
     }
     
     return $this->render('insert',['model'=>$model, 'Useritems'=>$Useritems,  'Caritems'=>$Caritems]);
  
    }

    public function actionUpdate($id)
    {
        $model = new UserCar();
        $model->id = $id;

        $Useritems=ArrayHelper::map(User::find()->all(),'id','name');
        $Caritems=ArrayHelper::map(Car::find()->all(),'id','name');

        $find =  UserCar::findOne($id);
        if ($find->load(Yii::$app->request->post()) && $find->validate()) {
            $data = Yii::$app->request->post();
            $find->user_id = $data["UserCar"]['user_id'];
            $find->car_id = $data["UserCar"]['car_id'];
    
            if ($find->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['usercar/index']);
            }
            
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',['model'=>$find, 'Useritems'=>$Useritems,  'Caritems'=>$Caritems]);

        }
    }

    public function actionDelete($id)
    {
        $find =  UserCar::findOne($id) ?? null;
        if ($find != null) {
            $find->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['usercar/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    }
}

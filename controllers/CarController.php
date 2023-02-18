<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Car;
use app\models\CarSearch;
use yii\data\ActiveDataProvider;



class CarController extends Controller
{

    public function actionIndex()
    {
        $carSearch = new CarSearch();
        return $this->render('index', [
            'dataProvider' => $carSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $carSearch
        ]);
    }

    public function actionInsert()
    {
        $car = new Car();
        if ($car->load(Yii::$app->request->post()) && $car->validate()) {
            $data = Yii::$app->request->post();
            $car->name = $data["Car"]['name'];
            if ($car->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['car/index']);
            }
        } else {
            return $this->render('insert', ['car' => $car]);
        }
    }

    public function actionUpdate($id)
    {
        $newCar = new Car();
        $newCar->id = $id;
        $car =  Car::findOne($id);
        if ($car->load(Yii::$app->request->post()) && $car->validate()) {
            $data = Yii::$app->request->post();
            $car->name = $data["Car"]['name'];
            if ($car->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['car/index']);
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',  ['car' => $car]);
        }
    }

    public function actionDelete($id)
    {
        $car =  Car::findOne($id) ?? null;
        if ($car != null) {
            $car->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['car/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    }
}

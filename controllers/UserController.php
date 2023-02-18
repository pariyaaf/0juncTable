<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\UserSearch;
use yii\data\ActiveDataProvider;



class UserController extends Controller
{

    public function actionIndex()
    {
        $userSearch = new UserSearch();
        return $this->render('index', [
            'dataProvider' => $userSearch->search(Yii::$app->request->queryParams),
            'searchModel' => $userSearch
        ]);
    }

    public function actionInsert()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            $data = Yii::$app->request->post();
            $user->name = $data["User"]['name'];
            $user->lastname = $data["User"]['lastname'];
            if ($user->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['user/index']);
            }
        } else {
            return $this->render('insert', ['user' => $user]);
        }
    }

    public function actionUpdate($id)
    {
        $newValue = new User();
        $newValue->id = $id;
        $user =  User::findOne($id);
        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            $data = Yii::$app->request->post();
            $user->name = $data["User"]['name'];
            $user->lastname = $data["User"]['lastname'];
            if ($user->save()) {
                Yii::$app->session->set('result', 'successfull!');
                return $this->response->redirect(['user/index']);
            }
            Yii::$app->session->set('result', 'feild!');
        } else {
            return $this->render('update',  ['user' => $user]);
        }
    }

    public function actionDelete($id)
    {
        $user =  User::findOne($id) ?? null;
        if ($user != null) {
            $user->delete();
            Yii::$app->session->set('result', 'successfull!');
            return $this->response->redirect(['user/index']);
        } else {
            Yii::$app->session->set('result', 'failed!');
            return $this->actionIndex();
        }
    }
}

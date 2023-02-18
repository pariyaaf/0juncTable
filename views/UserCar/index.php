<?php

use app\widgets\Alert;
use app\models\UserCar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$session = Yii::$app->session;
if ($session->isActive)
    $session->open();
?>

<h2><?php echo $session->get('result'); ?></h2>
<?php
$session->set('result', '');
?>
<?php
$this->title = 'User-Car';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>

<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('create', ['/usercar/insert'], ['class' => 'mx-2 btn btn-primary']) ?>

    </p>

    <?php
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
           [
            'attribute'=> 'user_id',
            'value' => function($model) { return  $model->user->name . " " . $model->user->lastname ;},
            'label'=>'User',
           ],

           [
            'attribute'=> 'car_id',
            'value'=>'car.name',
            'label'=>'Car ',
           ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserCar $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);


;?>    





</div>
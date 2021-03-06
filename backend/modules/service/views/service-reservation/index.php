<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\service\models\ServiceReservationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бронирования услуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-reservation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start',
            'end',
            'date',
            [
                'attribute' => 'product.title',
                'label' => 'Услуга'
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Пользователь',
                'value' => function($model){
                    return \common\models\User::findOne($model->user_id)->username;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

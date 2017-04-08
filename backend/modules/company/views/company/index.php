<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('company', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('company', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            'name',
            'address',
            'phone',
            /*'email:email',*/
            [
                'attribute' => 'vip',
                'format' => 'text',
                'value' => function($model){
                    return ($model->vip == 0) ? 'Стандарт' : 'VIP';
                },
                'filter'=> Html::activeDropDownList($searchModel, 'vip', [0=>'Стандарт',1=>'VIP'],['class'=>'form-control','prompt' => '']),
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model){
                    return ($model->status == 0) ? 'Опубликована' : 'На модерации';
                }
            ],
            // 'photo',
            // 'dt_add',
            // 'dt_update',
            // 'descr:ntext',
            // 'status',
            // 'slug',
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

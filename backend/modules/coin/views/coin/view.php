<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\Coin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coin', 'Coins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('coin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('coin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'coin_id',
            'url:url',
            'image_url:url',
            'name',
            'symbol',
            'coin_name',
            'full_name',
            'algorithm',
            'proof_type',
            'fully_premined',
            'total_coin_supply',
            'pre_mined_value',
            'total_coins_free_float',
            'sort_order',
            'sponsored',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 0:
                            return 'Скрыта';
                        case 1:
                            return 'Доступна для показа';
                    }
                },
            ],
        ],
    ]) ?>

</div>

<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 07.09.2016
 * Time: 11:30
 */

namespace backend\modules\news\models;


use yii\db\ActiveRecord;

class News extends \common\models\db\News
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15.01.18
 * Time: 12:39
 */

namespace backend\modules\products\models;

use common\models\db\CategoryShop;

class CategoryProduct extends CategoryShop
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['parent_id'] = ['parent_id', 'default', 'value' => 0];
        return $rules;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 03.04.18
 * Time: 13:39
 */

namespace frontend\modules\shop\widgets;

use common\classes\Debug;
use common\models\db\CategoryFields;
use yii\helpers\ArrayHelper;
use yii\jui\Widget;

class ShowFilterLeftProducts extends Widget
{
    public $categoryId;


    public function run()
    {

        $getFilter = \Yii::$app->request->get();

        //Debug::prn($getFilter);

        $fields = CategoryFields::find()
            ->joinWith('fields.productFieldsDefaultValues')
            ->where(['category_id' => $this->categoryId])
            ->groupBy('id')
            ->all();

        //Debug::dd($fields);
        //Debug::dd(ArrayHelper::getValue($fields['fields'], 'name'));

        $html = '';
        $fieldsName = [];
        if (!empty($fields)) {
            foreach ($fields as $item) {
                //Debug::dd($item);

                $fieldsName[$item['fields']->name.'[]'] = (isset($getFilter[$item['fields']->name])) ? $getFilter[$item['fields']->name] : [];
                $html .= $this->render('fields_filter', ['adsFields' => $item, 'getFilter' => $getFilter]);
            }
        }

        $fieldsName['minPrice'] = '';
        $fieldsName['maxPrice'] = '';
        $fieldsName['saleFilter'] = (isset($getFilter['saleFilter'])) ? $getFilter['saleFilter'] : '';
        $fieldsName['sort'] = (isset($getFilter['sort'])) ? $getFilter['sort'] : '';

        //return $html;
        return $this->render('filter-left', [
            'html' => $html,
            'fieldsName' => json_encode($fieldsName),
            'category' => $this->categoryId,
        ]);
    }
}
<?php

namespace frontend\modules\board\controllers;

use common\classes\Debug;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `board` module
 */
class DefaultController extends Controller
{
    public $siteApi;

    public function beforeAction($action)
    {
        $this->siteApi = Yii::$app->params['site-api'];
        return parent::beforeAction($action);
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        /*Debug::prn(Yii::$app->request->userIP);
        Debug::prn($_SERVER);*/

        $ads = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds');


        return $this->render('index',
            [
                'ads' => json_decode($ads),
            ]
        );
    }

    public function actionView($slug, $id)
    {
        $ads = file_get_contents($this->siteApi . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues');

        return $this->render('view',
            [
                'ads' => json_decode($ads),
            ]
        );
    }

    public function actionCreate()
    {
        if(Yii::$app->request->post()){

            $sURL = $this->siteApi . '/ads/create'; // URL-адрес POST

            unset($_POST['_csrf']);

            $sPD = http_build_query($_POST); // Данные POST
            $aHTTP = [
                'http' => // Обертка, которая будет использоваться
                    [
                        'method'  => 'POST', // Метод запроса
                        // Ниже задаются заголовки запроса
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $sPD,
                    ]
            ];
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            echo $contents;
        }

        return $this->render('add-form-ads');
    }

    public function actionGetChildrenCategory()
    {
        if(!empty(Yii::$app->request->post('catId'))) {
            $catId = Yii::$app->request->post('catId');
            //Debug::prn($catId);
            $cat = file_get_contents($this->siteApi . '/category?parent=' . $catId);

            if($cat != '[]'){
                return $this->renderPartial('children-category/category', ['cat' => json_decode($cat)]);
            }
            else{
                $fields = file_get_contents($this->siteApi . '/category/ads-fields?id=' . $catId);
                if(!empty($fields)){
                    $fields = json_decode($fields);
                    $html = '';
                    foreach ($fields as $item){
                        $html .= $this->renderPartial('children-category/filter_fields', ['adsFields' => $item]);
                    }
                    return $html;
                }

            }
        }
    }

    public function actionShowCityList()
    {
        $city = file_get_contents($this->siteApi . '/city?region=' . Yii::$app->request->post('id'));

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.02.18
 * Time: 13:49
 */

namespace frontend\modules\shop\controllers;

use common\classes\Cart;
use common\classes\Debug;
use common\classes\Shop;
use common\models\db\KeyValue;
use common\models\db\LikeProducts;
use common\models\db\ProductsImg;
use common\models\db\ServiceReservation;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ShopController extends Controller
{

    public $layout = 'shop';

    /**
     * Вывод страницы все категории магазина
     */
    public function actionIndex()
    {
        $category = Shop::getAllCategory();

        $modelProduct = new Products();
        $products = $modelProduct->listProduct(12);

        //Получаем meta title
        $meta_title = KeyValue::getValue('all_category_page_meta_title');
        if(!$meta_title)
            $meta_title = 'Все категории';

        //Получаем meta descripton
        $meta_descr = KeyValue::getValue('all_category_page_meta_descr');
        if(!$meta_descr)
            $meta_descr = 'Категории';

        return $this->render('all-category',
            [
                'meta_title' => $meta_title,
                'meta_descr' => $meta_descr,
                'category' => $category,
                'products' => $products,
            ]
        );
    }

    /**
     * вывод старницы промежуточной категории со списком товаров всех категорий
     * входящих в текущую или вывод списка товаров последней категории с фильтром
     * по этим товарам
     *
     * @param $category
     * @return string
     */
    public function actionCategory($category)
    {
        $model = new CategoryShop();
        $categoryModel = $model->getCategoryInfoBySlug($category);

        $modelProduct = new Products();
        if( count(Yii::$app->request->get()) > 1 && !Yii::$app->request->get('page')){
            $products = $modelProduct->listProductFilter(16, $categoryModel->id, Yii::$app->request->get());
        }
        else{
            $products = $modelProduct->listProduct(16, $categoryModel->id);
        }

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($categoryModel->id, []);



        if ($model->getEndCategory($category)) {
            $category = CategoryShop::find()->where(['type' => CategoryShop::TYPE_PRODUCT])->all();
            $categoryTreeArr = $categoryModel->getArrayTreeCategory($category);
            return $this->render('category',
                [
                    'categoryInfo' => $categoryModel,
                    'categoryTreeArr' => $categoryTreeArr,
                    'ollCategory' => ArrayHelper::index($category, 'id'),
                    'products' => $products,
                    'categoryList' => $categoryList,
                ]);
        }

        return $this->render('list-products',
            [
                'categoryInfo' => $categoryModel,
                'products' => $products,
                'categoryList' => $categoryList,
            ]);

    }

    /**
     * Вывод страницы карточки товара
     * @param $slug
     * @return string
     */
    public function actionShow($slug)
    {
        $this->layout = 'single-shop';
        $model = Products::find()
            ->where(['slug' => $slug, 'type' => Products::TYPE_PRODUCT])
            ->with('productFieldsValues.field', 'company.allPhones', 'images', 'category', 'reviews')
            ->one();
        $currentUserId = Yii::$app->user->id;
        if (!empty($currentUserId)) {
            $thisUserLike = LikeProducts::find()
                ->where(['product_id' => $model->id, 'user_id' => $currentUserId])->one();
            if (!empty($thisUserLike)) {
                $thisUserLike = true;
            }

        } else {
            $thisUserLike = false;
        }

        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($model->category_id, []);
        return $this->render('view',
            [
                'model' => $model,
                'like' => $thisUserLike,
                'categoryList' => $categoryList,
            ]
        );
    }
    public function actionShowService($slug)
    {
        $this->layout = 'single-shop';
        $model = Products::find()
            ->where(['slug' => $slug, 'type' => Products::TYPE_SERVICE])
            ->with('productFieldsValues.field', 'company.allPhones', 'images', 'category', 'reviews', 'service')
            ->one();
        $reservations = ServiceReservation::find()->where(['product_id' => $model->id])->all();
        $currentUserId = Yii::$app->user->id;
        if (!empty($currentUserId)) {
            $thisUserLike = LikeProducts::find()
                ->where(['product_id' => $model->id, 'user_id' => $currentUserId])->one();
            if (!empty($thisUserLike)) {
                $thisUserLike = true;
            }

        } else {
            $thisUserLike = false;
        }

        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($model->category_id, []);
        return $this->render('view-service',
            [
                'model' => $model,
                'like' => $thisUserLike,
                'categoryList' => $categoryList,
                'reservations' => $reservations
            ]
        );
    }

    public function actionProductReviews($slug)
    {
        $this->layout = 'single-shop';
        $model = Products::find()
            ->where(['slug' => $slug, 'type' => Products::TYPE_PRODUCT])
            ->with('productFieldsValues.field', 'company.allPhones', 'images', 'category', 'reviews')
            ->one();

        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($model->category_id, []);
        return $this->render('reviews-products',
            [
                'model' => $model,
                'categoryList' => $categoryList,
            ]
        );
    }

    /**
     * Добавить в мои желания товар
     * @return bool
     */
    public function actionLike()
    {
        $userId = Yii::$app->user->id;
        if (!$userId) {
            return true;
        }

        $postData = Yii::$app->request->post();

        $like = LikeProducts::find()->where(['product_id' => $postData['product_id'], 'user_id' => $userId])->one();

        if (empty($like)) {
            $like = new LikeProducts();
            $like->product_id = $postData['product_id'];
            $like->user_id = $userId;
            $like->dt_add = time();

            $like->save();
            return true;
        } else {
            LikeProducts::deleteAll(['product_id' => $postData['product_id'], 'user_id' => $userId]);
            return false;
        }
    }

    /**
     * SEARCH
     */
    public function actionSearch()
    {
        $get = Yii::$app->request->get();
        $modelProduct = new Products();
        $products = $modelProduct->listProduct(16, $get['categorySearch'], $get['textSearch']);

        return $this->render('search',
            [
                'products' => $products,
            ]);
    }

    /**
     * FILTER
     */
    public function actionFilter()
    {
        $request = Yii::$app->request->post();
        //Debug::prn($request);
        //$request['category'] = 2;

        //Debug::dd(json_decode($request['filter'])) ;
        //$model = new CategoryShop();
        //$categoryModel = $model->getCategoryInfoBySlug();

        $modelProduct = new Products();

        $products = $modelProduct->listProductFilter(16, $request['category'], json_decode($request['filter']) );

        return $this->renderPartial('filter-products',
            [
                'products' => $products,
            ]);
    }

    public function actionGetPeriod(){
        $model = Products::find()->where(['id' => Yii::$app->request->post('id')])->one();
        $date = Yii::$app->request->post('date');
        return $this->renderPartial('service-buttons',[
            'model' => $model,
            'date' => $date
        ]);
    }
    public function actionAddReservation(){
        $id = Yii::$app->request->post('id');
        $date = Yii::$app->request->post('date');
        $time = Yii::$app->request->post('time');
        $time = explode('-', $time);
        $reservation = new ServiceReservation();
        $reservation->start = $time[0];
        $reservation->end = $time[1];
        $reservation->product_id = $id;
        $reservation->date = $date;
        if($reservation->save())
            return true;
        else return false;
    }
}

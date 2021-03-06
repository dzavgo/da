<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $company_id
 * @property int $category_id
 * @property string $description
 * @property int $price
 * @property int $new_price
 * @property int $status
 * @property string $cover
 * @property int $dt_add
 * @property int $dt_update
 * @property int $user_id
 * @property int $view
 * @property string $payment
 * @property string $delivery
 * @property string $stock_descr
 * @property integer $hit
 * @property integer $stock
 * @property integer $type
 * @property integer $durability
 * @property integer $person_count
 *
 * @property ServicePeriods[] $service
 * @property ServiceReservation[] $reservations
 * @property LikeProducts[] $likeProducts
 * @property ProductFieldsValue[] $productFieldsValues
 * @property CategoryShop $category
 * @property Company $company
 * @property ProductsImg[] $productsImgs
 * @property ProductsReviews[] $productsReviews
 */
class Products extends \yii\db\ActiveRecord
{
    public $hit;
    public $stock;

    const TYPE_PRODUCT = 0;
    const TYPE_SERVICE = 1;

    public static $productTypes = [
        self::TYPE_PRODUCT => 'Товар',
        self::TYPE_SERVICE => 'Услуга'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'company_id', 'category_id', 'description', 'price'], 'required'],
            [
                [
                    'company_id',
                    'category_id',
                    'price',
                    'new_price',
                    'status',
                    'dt_add',
                    'dt_update',
                    'user_id',
                    'view',
                    'hit',
                    'stock',
                    'type',
                    'durability',
                    'person_count'
                ],
                'integer',
            ],
            [['description', 'payment', 'delivery', 'stock_descr'], 'string'],
            [['title', 'slug', 'cover'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CategoryShop::className(),
                'targetAttribute' => ['category_id' => 'id'],
            ],
            [
                ['company_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::className(),
                'targetAttribute' => ['company_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'company_id' => 'Company',
            'category_id' => 'Category',
            'description' => 'Description',
            'price' => 'Price',
            'new_price' => 'New Price',
            'status' => 'Status',
            'cover' => 'Cover',
            'dt_add' => 'Dt Add',
            'dt_update' => 'Dt Update',
            'user_id' => 'User ID',
            'view' => 'View',
            'payment' => 'Payment',
            'delivery' => 'Delivery',
            'hit' => 'Хит продаж',
            'type' => 'Type',
            'durability' => 'Durability',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->hit) {
                $pm = ProductMark::findOne(['product_id' => $this->id, 'mark' => ProductMark::MARK_HIT]);
                if ($pm === null) {
                    $pm = new ProductMark();
                    $pm->product_id = $this->id;
                    $pm->mark = ProductMark::MARK_HIT;
                    $pm->save();
                }
            } else {
                ProductMark::deleteAll(['product_id' => $this->id, 'mark' => ProductMark::MARK_HIT]);
            }

            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($this->stock) {
            if (!ProductMark::hasMark($this->id, ProductMark::MARK_STOCK)) {
                ProductMark::setMark($this->id, ProductMark::MARK_STOCK);
            }
        } else {
            ProductMark::delMark($this->id, ProductMark::MARK_STOCK);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikeProducts()
    {
        return $this->hasMany(LikeProducts::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFieldsValues()
    {
        return $this->hasMany(ProductFieldsValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryShop::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsImgs()
    {
        return $this->hasMany(ProductsImg::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsReviews()
    {
        return $this->hasMany(ProductsReviews::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductsImg::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(ProductsReviews::class, ['product_id' => 'id']);
    }

    public function getHitValue()
    {
        return (bool)ProductMark::findOne(['product_id' => $this->id, 'mark' => ProductMark::MARK_HIT]);
    }

    public function getStockValue()
    {
        return ProductMark::hasMark($this->id, ProductMark::MARK_STOCK);
    }

    public function hasMark($mark)
    {
        if (ProductMark::findOne(['product_id' => $this->id, 'mark' => $mark]))
            return true;
        return false;
    }

    //Проверяет прошло ли указанное количество дней с момента добавления товара
    public function daysPassed($days)
    {
        if (time() - $this->dt_add < 86400 * $days)
            return true;
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasMany(ServicePeriods::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(ServiceReservation::className(), ['product_id' => 'id']);
    }
    
    public function setServiceWeekDays($index, $value)
    {
        $this->service[$index]->week_days = $value;
    }

}

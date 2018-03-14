<?php

namespace common\models\db;

use common\classes\Tariff;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $photo
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $descr
 * @property integer $status
 * @property string $slug
 * @property integer $lang_id
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $views
 * @property integer $user_id
 * @property integer $vip
 * @property integer $tariff_id
 * @property integer $dt_end_tariff
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $recommended
 * @property integer $main
 * @property integer $verifikation
 * @property string $alt
 * @property string $delivery
 * @property string $payment
 *
 * @property CategoryCompanyRelations[] $categoryCompanyRelations
 * @property News[] $news
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['dt_add', 'dt_update', 'status', 'lang_id', 'views', 'user_id', 'vip', 'tariff_id', 'dt_end_tariff', 'region_id', 'city_id', 'recommended', 'main', 'verifikation'], 'integer'],
            [['descr', 'payment', 'delivery'], 'string'],
            [
                ['name', 'address', 'phone', 'email', 'photo', 'slug', 'meta_title', 'meta_descr', 'alt'],
                'string',
                'max' => 255,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('company', 'ID'),
            'name' => Yii::t('company', 'Name'),
            'address' => Yii::t('company', 'Address'),
            'phone' => Yii::t('company', 'Phone'),
            'email' => Yii::t('company', 'Email'),
            'photo' => Yii::t('company', 'Photo'),
            'dt_add' => Yii::t('company', 'Dt Add'),
            'dt_update' => Yii::t('company', 'Dt Update'),
            'descr' => Yii::t('company', 'Descr'),
            'status' => Yii::t('company', 'Status'),
            'slug' => Yii::t('company', 'Slug'),
            'lang_id' => Yii::t('company', 'Lang ID'),
            'meta_title' => Yii::t('company', 'Meta Title'),
            'meta_descr' => Yii::t('company', 'Meta Descr'),
            'views' => Yii::t('company', 'Views'),
            'user_id' => Yii::t('company', 'User ID'),
            'vip' => Yii::t('company', 'Vip'),
            'tariff_id' => Yii::t('company', 'Tariff'),
            'recommended' => Yii::t('company', 'Recommended'),
            'main' => Yii::t('company', 'Main'),
            'verifikation' => Yii::t('company', 'Verifikation'),
            'alt' => Yii::t('company', 'Alt Tag'),
            'delivery' => Yii::t('company', 'Delivery'),
            'payment' => Yii::t('company', 'Payment'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        $companyPhotos = Yii::$app->request->post('company-photos');
        CompanyPhoto::savePhotos($this->id, $companyPhotos);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCompanyRelations()
    {
        return $this->hasMany(CategoryCompanyRelations::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CategoryCompany::className(), ['id' => 'cat_id'])->via('categoryCompanyRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(\common\models\db\Tariff::className(), ['id' => 'tariff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllPhones()
    {
        return $this->hasMany(Phones::className(), ['company_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    /**
     * @param $id
     * @return null|static|$this
     */
    public static function findById($id)
    {
        return static::findOne($id);
    }

    /**
     * @return array
     */
    public function getPhones()
    {
        return explode(' ', $this->phone);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasMany(Stock::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocCompany()
    {
        return $this->hasMany(SocCompany::className(), ['company_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getFullAndEmptySocials()
    {
        $allTypes = SocAvailable::getIds();
        $currentSocial = $this->getSocCompany()->all();
        $currentSocialTypes = ArrayHelper::getColumn($currentSocial, 'soc_type');
        $diffSocModels = array_diff($allTypes, $currentSocialTypes);
        $newSocial = [];
        foreach ($diffSocModels as $type) {
            $newSocial[] = new SocCompany([
                'company_id' => $this->id,
                'soc_type' => $type
            ]);
        }
        return array_merge($currentSocial, $newSocial);
    }
}

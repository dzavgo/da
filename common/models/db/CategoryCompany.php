<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_company".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $descr
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_descr
 * @property string $slug
 * @property integer $lang_id
 *
 * @property CategoryCompanyRelations[] $categoryCompanyRelations
 */
class CategoryCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'dt_add', 'dt_update', 'lang_id'], 'integer'],
            [['descr'], 'string'],
            [['title', 'icon', 'meta_title', 'meta_descr', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('company', 'ID'),
            'title' => Yii::t('company', 'Title'),
            'parent_id' => Yii::t('company', 'Parent ID'),
            'descr' => Yii::t('company', 'Descr'),
            'dt_add' => Yii::t('company', 'Dt Add'),
            'dt_update' => Yii::t('company', 'Dt Update'),
            'icon' => Yii::t('company', 'Icon'),
            'meta_title' => Yii::t('company', 'Meta Title'),
            'meta_descr' => Yii::t('company', 'Meta Descr'),
            'slug' => Yii::t('company', 'Slug'),
            'lang_id' => Yii::t('company', 'Lang ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCompanyRelations()
    {
        return $this->hasMany(CategoryCompanyRelations::className(), ['cat_id' => 'id']);
    }
}

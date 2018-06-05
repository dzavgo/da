<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "google_plus_posts".
 *
 * @property int $id
 * @property string $updated
 * @property string $published
 * @property string $title
 * @property string $post_id
 * @property string $url
 * @property int $user_id
 */
class GooglePlusPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'google_plus_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['updated', 'published', 'post_id', 'url'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'updated' => 'Updated',
            'published' => 'Published',
            'title' => 'Title',
            'post_id' => 'Post ID',
            'url' => 'Url',
            'user_id' => 'User ID',
        ];
    }
}
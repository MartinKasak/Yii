<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_views".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property string $view_time
 */
class PostViews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['view_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'view_time' => 'View Time',
        ];
    }
}

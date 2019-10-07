<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $topic_id
 * @property int $owner_id
 * @property string $creation_time
 * @property int $deleted
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['content'], 'string'],
            [['topic_id', 'owner_id', 'deleted'], 'integer'],
            [['creation_time'], 'safe'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'topic_id' => 'Topic ID',
            'owner_id' => 'Owner ID',
            'creation_time' => 'Creation Time',
            'deleted' => 'Deleted',
        ];
    }

    public function getOwnerName() {
        $id = $this->owner_id;
        $owner = User::findIdentity($id);
        return $owner->username;
    }
}

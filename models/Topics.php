<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topics".
 *
 * @property int $id
 * @property string $name
 * @property int $owner_id
 * @property string $creation_time
 * @property int $deleted
 */
class Topics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['owner_id', 'deleted'], 'integer'],
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
            'owner_id' => 'Owner ID',
            'creation_time' => 'Creation Time',
            'deleted' => 'Deleted',
        ];
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if($this->owner_id == null) {
				$this->owner_id = Yii::$app->user->identity->id;
			}
			return true;
		} else {
			return false;
		}
	}
    
    public function getOwnerName() {
        $id = $this->owner_id;
        $owner = User::findIdentity($id);
        return $owner->username;
    }
}
